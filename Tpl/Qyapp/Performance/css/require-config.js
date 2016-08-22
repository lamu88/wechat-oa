//http://stackoverflow.com/questions/17341015/require-js-is-ignoring-my-config


//requirejs.config({
var require = {
    baseUrl: window._globalRequireBaseUrl || 'js',
    paths: {
		dialog: 'MOA.dialog',
		business: 'MOA.business',
		members: 'MOA.members',
		addressbook: 'MOA.addressbook', //ÓÃÓÚÖð²½Ìæ»»members
		touchslider: 'MOA.touchslider',
		listactions: 'MOA.listactions',
		timeslider: 'MOA.timeslider',
		hsliderchooser: 'MOA.hsliderchooser',
		a2z: 'MOA.a2z',
		h5uploader: 'MOA.h5uploader',
		imageCompresser: 'MOA.ImageCompresser',
		h5audio: 'MOA.h5audio',
		formvalidate: 'MOA.formvalidate',
		template: 'MOA.template',
		
		Underscore: 'underscore-min',
		templates: '../templates'
    },
	shim: {
		Underscore: {
		  exports: '_'
		}
	},
	waitSeconds: 20
};
//});