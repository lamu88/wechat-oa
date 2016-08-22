document.addEventListener('WeixinJSBridgeReady', function() {
	// WeixinJSBridge.call('hideOptionMenu');
}, false);
window.onload = function() {
	var body = document.querySelector(".body");
	var pageForm = document.querySelector("#page-form")
	var companyRight = document.querySelector(".copyright");
	var multiScore = document.querySelectorAll(".multi-score");
	var singleChoose = document.querySelectorAll(".single-choose");
	var multiChoose = document.querySelectorAll(".multi-choose");

	// body.style.height = (window.innerHeight - companyRight.offsetHeight) + "px";

	// new iScroll(body);


	if (window.innerHeight < document.body.scrollHeight) {
		companyRight.classList.remove("bottom");
	} else {
		companyRight.classList.add("bottom");
	}

	if (pageForm) {
		pageForm.canSubmit = true;
		pageForm.addEventListener("submit", function(e) {
			e.preventDefault();
			if (!checkFormData())
				return;
			if (!pageForm.canSubmit)
				return;

			pageForm.canSubmit = false;
			$.post(pageForm.action, $('form').serialize(), function(result) {
				var data = JSON.parse(result);
				if (data.errno == 0) {
					alert(data.error, {
						callBack: function() {
							WeixinJSBridge.invoke('closeWindow');
							// if (data.path)
								// window.location.href = data.path;
						}
					});
				} else {
					alert(data.error);
				}
			});
		}, false);
	}

	function checkFormData() {
		var required = parseInt(pageForm.dataset.require);
		if (required) {
			var data = $('form').serializeArray();
			for (var i = 0; data[i]; i++) {
				if (data[i]["value"] == "") {
					alert("您还有题目未作答，请全部做答后提交！");
					return false;
				}
			}
			return true;
		}
		return true;
	}

	for (var i = 0, score; score = multiScore[i]; i++) {
		var questions = score.querySelectorAll("ul");
		for (var z = 0; questions[z]; z++) {
			var chooseScores = questions[z].querySelectorAll("a");
			for (var j = 0, chooseScore; chooseScore = chooseScores[j]; j++) {
				chooseScore.addEventListener("click", changeStar.bind(this, chooseScore, j), false);
			}
		}
	}

	for (var i = 0, sChoose; sChoose = singleChoose[i]; i++) {
		var chooses = sChoose.querySelectorAll("dd");
		for (var z = 0, choose; choose = chooses[z]; z++) {
			choose.addEventListener("click", changeSingle.bind(this, choose, z), false);
		}
	}

	for (var i = 0, mChoose; mChoose = multiChoose[i]; i++) {
		var chooses = mChoose.querySelectorAll("dd");
		for (var z = 0, choose; choose = chooses[z]; z++) {
			choose.addEventListener("click", changeMulti.bind(this, choose, z), false);
		}
	}

	function changeStar(obj, num) {
		var liDom = obj.parentNode;
		var ulDom = liDom.parentNode;
		ulDom.className = "star" + (num + 1);
		document.querySelector("[name=" + ulDom.id + "]").value = (num + 1);
	}

	function changeSingle(obj, index) {
		var dlDom = obj.parentNode;
		for (var i = 0, per; per = dlDom.children[i]; i++) {
			if (per == obj)
				per.className = "choosed";
			else
				per.className = "";
		}
		document.querySelector("[name=" + dlDom.id + "]").value = index;
	}

	function changeMulti(obj, index) {
		var dlDom = obj.parentNode;
		var target = document.querySelector("[name=" + dlDom.id + "]");
		var choosed = target.value.split(",");
		if (obj.classList.contains("choosed")) {
			obj.classList.remove("choosed");
			var values = "";
			for (var i = 0; i < choosed.length; i++) {
				if (choosed[i] != index && choosed[i] != "")
					values += "," + choosed[i];
			}
			target.value = values;
		} else {
			obj.classList.add("choosed");
			target.value += "," + index;
		}
	}
}