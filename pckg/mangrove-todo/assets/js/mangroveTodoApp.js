var mangroveTodoApp = angular.module("mangroveTodoApp",
	[
		'ui.router', 'ngAnimate', 'ui.bootstrap',
		'mangroveBase'
	]
);

jurl = function (name) {
	return "components/com_mangrovetodo/templates/" + name + ".html";
};

mangroveTodoApp
	.config(
	[
	'$stateProvider', '$urlRouterProvider', 'RestangularProvider',
	function ($stateProvider, $urlRouterProvider, RestangularProvider)
	{
		RestangularProvider.setBaseUrl('index.php?option=com_mangrovetodo&path=');

		$urlRouterProvider.otherwise('/todo');

		$stateProvider
			.state('todo', {
				url: '/todo',
				views: {
					"main":   { templateUrl: jurl('todos.list') },
					"header": { templateUrl: jurl('header') },
					"footer": { templateUrl: jurl('footer') }
				}
			})
		;
	}
	]
);

mangroveTodoApp
	.controller('TodoListCtrl',
	[
	'$scope', '$state', 'dataPersist', 'filterFilter',
	function ($scope, $state, dataPersist, filterFilter)
	{
		dataPersist.bindResource($scope, {res: 'todo'})
			.then(function(){
				$scope.$watch('todos', function (todos, oldTodos) {
					$scope.remaining  = _.filter($scope.todos, 'completed').length;
					$scope.completed  = todos.length - $scope.remaining;
					$scope.checked    = !$scope.remaining;
				}, true);
			});

		$scope.markAll = function() {
			angular.forEach($scope.todos, function(todo){
				todo.completed = !$scope.checked;
			});

			Platform.performMicrotaskCheckpoint();
		};

		$scope.clearCompleted = function() {
			$scope.todos = _.filter($scope.todos, 'completed');

			Platform.performMicrotaskCheckpoint();
		};
	}
	]
);

mangroveTodoApp
	.filter( 'statusFilter',
	function () {
		return function (todos, something, status) {
			if ( status == '' ) return completed;

			var list = [];
			angular.forEach(todos, function(todo){
				if ( status == 'active' && !todo.completed ) {
					list.push(todo);
				} else if ( status == 'completed' && todo.completed ) {
					list.push(todo);
				}
			});

			return list;
		};
	}
);

mangroveTodoApp
	.directive( 'todoEscape',
	function () {
		return function (scope, elem, attrs) {
			elem.bind('keydown', function (event) {
				if (event.keyCode === 27) scope.$apply(attrs.todoEscape);
			});
		};
	}
);

mangroveTodoApp
	.directive( 'todoFocus',
	function todoFocus($timeout) {
		return function (scope, elem, attrs) {
			scope.$watch(attrs.todoFocus, function (newVal) {
				if (newVal) {
					$timeout(function () { elem[0].focus(); }, 0, false);
				}
			});
		};
	}
);
