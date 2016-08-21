<?php
class MySQLReback {
	private $config;
	private $content;
	private $dbName = array ();
	const DIR_SEP = DIRECTORY_SEPARATOR;
	public function __construct($config) {
		$this->config = $config;
		header ( "Content-type: text/html;charset=utf-8" );
		$this->connect ();
	}
	private function connect() {
		if (mysql_connect ( $this->config ['host'] . ':' . $this->config ['port'], $this->config ['userName'], $this->config ['userPassword'] )) {
			mysql_query ( "SET NAMES '{$this->config['charset']}'" );
			mysql_query ( "set interactive_timeout=24*3600" );
		} else {
			$this->throwException ( '无法连接到数据库!' );
		}
	}
	public function setDBName($dbName = '*') {
		if ($dbName == '*') {
			$rs = mysql_list_dbs ();
			$rows = mysql_num_rows ( $rs );
			if ($rows) {
				for($i = 0; $i < $rows; $i ++) {
					$dbName = mysql_tablename ( $rs, $i );
					$block = array (
							'information_schema',
							'mysql' 
					);
					if (! in_array ( $dbName, $block )) {
						$this->dbName [] = $dbName;
					}
				}
			} else {
				$this->throwException ( '没有任何数据库!' );
			}
		} else {
			$this->dbName = func_get_args ();
		}
	}
	private function getFile($fileName) {
		$this->content = '';
		$fileName = $this->trimPath ( $this->config ['path'] . self::DIR_SEP . $fileName );
		if (is_file ( $fileName )) {
			$ext = strrchr ( $fileName, '.' );
			if ($ext == '.sql') {
				$this->content = file_get_contents ( $fileName );
			} elseif ($ext == '.gz') {
				$this->content = implode ( '', gzfile ( $fileName ) );
			} else {
				$this->throwException ( '无法识别的文件格式!' );
			}
		} else {
			$this->throwException ( '文件不存在!' );
		}
	}
	private function setFile($fileName) {
		$recognize = '';
		$this->content = '';
		$fileName = $this->trimPath ( $this->config ['path'] . self::DIR_SEP . $fileName );
		$this->content=file_get_contents ( $fileName );
		$recognize = implode ( '_', $this->dbName );
		
		$path = $this->setPath ( $fileName );
		if ($path !== true) {
			$this->throwException ( "无法创建备份目录目录 '$path'" );
		}
		if ($this->config ['isCompress'] == 0) {
			if (! file_put_contents ( $fileName, $this->content, LOCK_EX )) {
				$this->throwException ( '写入文件失败,请检查磁盘空间或者权限!' );
			}
		} else {
			if (function_exists ( 'gzwrite' )) {
				$fileName .= '.gz';
				if ($gz = gzopen ( $fileName, 'wb' )) {
					gzwrite ( $gz, $this->content );
					gzclose ( $gz );
				} else {
					$this->throwException ( '写入文件失败,请检查磁盘空间或者权限!' );
				}
			} else {
				$this->throwException ( '没有开启gzip扩展!' );
			}
		}
		if ($this->config ['isDownload']) {
			$this->downloadFile ( $fileName );
		}
	}
	private function trimPath($path) {
		return str_replace ( array (
				'/',
				'\\',
				'//',
				'\\\\' 
		), self::DIR_SEP, $path );
	}
	private function setPath($fileName) {
		$dirs = explode ( self::DIR_SEP, dirname ( $fileName ) );
		$tmp = '';
		foreach ( $dirs as $dir ) {
			$tmp .= $dir . self::DIR_SEP;
			if (! file_exists ( $tmp ) && ! @mkdir ( $tmp, 0777 ))
				return $tmp;
		}
		return true;
	}

	private function downloadFile($fileName) {
		ob_end_clean ();
		header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
		header ( 'Content-Description: File Transfer' );
		header ( 'Content-Type: application/octet-stream' );
		header ( 'Content-Length: ' . filesize ( $fileName ) );
		header ( 'Content-Disposition: attachment; filename=' . basename ( $fileName ) );
		readfile ( $fileName );
	}
	private function backquote($str) {
		return "`{$str}`";
	}
	private function getTables($dbName) {
		@$rs = mysql_list_tables ( $dbName );
		$rows = mysql_num_rows ( $rs );
		$dbprefix = $this->config ['dbprefix'];
		for($i = 0; $i < $rows; $i ++) {
			$tbName = mysql_tablename ( $rs, $i );
			if (substr ( $tbName, 0, strlen ( $dbprefix ) ) == $dbprefix) {
				$tables [] = $tbName;
			}
		}
		return $tables;
	}
	private function chunkArrayByByte($array, $byte = 5120) {
		$i = 0;
		$sum = 0;
		foreach ( $array as $v ) {
			$sum += strlen ( $v );
			if ($sum < $byte) {
				$return [$i] [] = $v;
			} elseif ($sum == $byte) {
				$return [++ $i] [] = $v;
				$sum = 0;
			} else {
				$return [++ $i] [] = $v;
				$i ++;
				$sum = 0;
			}
		}
		return $return;
	}
	
	public function recover($fileName) {
	    
		$this->getFile ( $fileName);
		
		if (! empty ( $this->content )) {
			$content = explode ( ';', $this->content );
			
			foreach ( $content as $i => $sql ) {
				$sql = trim ( $sql );
			   
				if (! empty ( $sql )) {
					$dbName = $this->dbName [0];
					
					if (! mysql_select_db ( $dbName ))
						$this->throwException ( '不存在的数据库!' . mysql_error () );
					$rs = mysql_query ( $sql );
					
					if ($rs) {
					    
						if (strstr ( $sql, 'CREATE DATABASE' )) {
							$dbNameArr = sscanf ( $sql, 'CREATE DATABASE %s' );
							$dbName = trim ( $dbNameArr [0], '`' );
							mysql_select_db ( $dbName );
						}
					} else {
					    
						//$this->throwException ( '备份文件被损坏!' . mysql_error () );
					}
					
				}
			}
		} else {
			//$this->throwException ( '无法读取备份文件!' );
		}
		
		return true;
	}
	private function throwException($error) {
		throw new Exception ( $error );
	}
}
?>