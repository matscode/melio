'use strict';

// Initialize controller
(function () {
	angular
		.module('melio',
			[
				'ngRoute',
				// 'ngToast'
			])

		// SPA Configuration
		.config([
			'$routeProvider',
			'$locationProvider',
			'$resourceProvider',
			'$httpProvider',

			function ($routeProvider, $locationProvider, $resourceProvider, $httpProvider) {

				// $routeProvider
				// .when('/test', {
				// 	templateUrl: 'views/partials/test.html',
				// 	controller: 'TestController'
				// });

				// ignoring the html5 push state.. its pretty dumb using it with CI: hashbang URL mode
				// $locationProvider.html5Mode(true);

				// !Don't strip trailing slashes from calculated URLs
				$resourceProvider.defaults.stripTrailingSlashes = true;
				// set the default behaviour wanted for RESTful POST
				$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
			}]);

})();