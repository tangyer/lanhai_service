$(".upload").each(function(){

	let _this = $(this);
	let toObj = $("#"+_this.data("to"));
	let uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight',
		browse_button : $(this).prop("id"), // you can pass an id...
		// container: document.getElementById('container'), // ... or DOM Element itself
		url : ctx + '/ajax/upload',
		flash_swf_url : 'Moxie.swf',
		silverlight_xap_url : 'js/Moxie.xap',
		// headers:{"X-CSRF-TOKEN":parent.$("meta[name='csrf-token']").prop("content")},
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"},
			]
		},

		init: {
			PostInit: function() {

			},

			FilesAdded: function(up, files) {
				var file = files[0];
				var html = ['<span class="text-primary mr-1">'+file.name+'</span>'];
				html.push('<button type="button" data-id="'+file.id+'" data-status="0" class="btn btn-sm btn-success up-start">开始上传</button>');
				html.push('<button type="button" data-id="'+file.id+'" class="btn btn-sm btn-danger del-upload ml-2">取消</button>');

				var parentObj = _this.parent();
				if (parentObj.children(".pl-content").length === 0) {
					parentObj.append('<div class="pl-content mt-2"></div>');
				}
				parentObj.children(".pl-content").html(html.join(""));
				// 绑定上传按钮开始事件
				parentObj.find(".up-start").on("click", function() {
					uploader.start();
				});
				// 绑定上传按钮开始事件
				parentObj.find(".del-upload").on("click", function() {
					uploader.removeFile(file);
					parentObj.children(".pl-content").html("");
				});
			},

			BeforeUpload:function (uploader,file){
				uploader.setOption({headers:{"X-CSRF-TOKEN":parent.$("meta[name='csrf-token']").prop("content")}})
			},

			UploadProgress: function(up, file) {
				// document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},

			Error: function(up, err) {
			}
		}
	});

	uploader.init();
	uploader.bind("FileUploaded", function(up, file, info) {
		let token = info.responseHeaders.substr(info.responseHeaders.indexOf("__token__") + 11,32);
		parent.$("meta[name='csrf-token']").prop("content",token);
		let res = JSON.parse(info.response);
		if (res.code  === 1){
			uploadFinish(res, file.name,file.id);
		}else{
			$.modal.alert(res.msg);
			_this.parent().children(".pl-content").html("");
		}

	});
	function uploadFinish(res, name,id) {
		let html = '<a href="'+res.data.path+'" class="photo mr-1" rel="group" title="'+_this.data("title")+'"><img src="'+res.data.path+'" width="100"></a>';;
		_this.parent().children(".pl-content").html(html);
		toObj.val(res.data.path);
	}

});

