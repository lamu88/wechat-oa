var LoadingManager = function(_p) {
	var loadingBox = null;
	var main = {
		show: function() {
			loadingBox.classList.add("show");
		},
		hide: function() {
			loadingBox.classList.remove("show");
		},
		progress: function(progress) {
			loadingBox.innerHTML = progress;
		}
	}

	function create(_p) {
		loadingBox = document.createElement("div");
		loadingBox.className = "loading-box";
		loadingBox.style.lineHeight = (window.innerHeight + 60 )+ 'px';
		_p = _p || document.body;
		_p.appendChild(loadingBox);
	}
	create(_p);
	return main;
}