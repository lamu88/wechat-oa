/**
 * ajax 模拟上传form表单
 * 需要conform.js,loading.js
 */

var AjaxForm = function() {
	var fd = new FormData();
	var xhr = new XMLHttpRequest();
	var loading = new LoadingManager(document.body);
	var confirmBox = new ConfirmBox(document.body);
	var completeCallback = null;

	xhr.upload.addEventListener("progress", uploadProgress, false);
	xhr.addEventListener("load", uploadComplete, false);
	xhr.addEventListener("error", uploadFailed, false);
	xhr.addEventListener("abort", uploadCanceled, false);

	function uploadProgress(e) {
		if (e.lengthComputable) {
			var percentComplete = Math.round(e.loaded * 100 / e.total);
			loading.progress("正在上传:" + percentComplete.toString() + "%");
		} else {
			confirmBox.show("无法计算上传大小!");
		}
	}

	function uploadComplete(e) {
		loading.hide();
		typeof completeCallback == "function" && completeCallback();
	}

	function uploadFailed(e) {
		loading.hide();
		confirmBox.show("上传过程中出现问题,请重新上传!");
	}

	function uploadCanceled(e) {
		loading.hide();
		confirmBox.show("网络异常,请稍候再试!");
	}

	var main = {
		append: function(name, content) {
			fd.append(name, content);
		},
		post: function(url, callback) {
			completeCallback = callback;

			loading.show();
			xhr.open("post", url);
			xhr.send(fd);
		}
	};
	return main;
};