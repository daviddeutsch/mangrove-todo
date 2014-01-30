var mangroveTodoApp = angular.module("mangroveTodoApp",
	[
		'restangular', 'ngRoute', 'ui.router',
		'ngAnimate', 'ui.bootstrap', 'OmniBinder',
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
							"main": {
								templateUrl: jurl('todos.list')
							},
							"header": {
								templateUrl: jurl('header')
							},
							"footer": {
								templateUrl: jurl('footer')
							}
						}
					})
				;
			}
		]
	);

mangroveTodoApp
	.controller('HeadCtrl',
		[
		'$scope',
		function ($scope)
		{
			$scope.add = function() {
				$scope.todos.push({title:$scope.newTodo});

				$scope.newTodo = '';
			};
		}
		]
	);

mangroveTodoApp
	.controller('TodoCtrl',
		[
		'$scope',
		function ($scope)
		{
			$scope.remove = function() {
				for ( var i=0; i<$scope.todos.length; i++ ) {
					item = $scope.todos[i];
					if (item.id == $scope.todo.id) {
						$scope.todos.splice(i, 1);

						Platform.performMicrotaskCheckpoint();
					}
				}
			};
		}
		]
	);

mangroveTodoApp
	.controller('TodoListCtrl',
		[
		'$scope', '$state', 'dataPersist', 'filterFilter',
		function ($scope, $state, dataPersist, filterFilter)
		{
			dataPersist.getList($scope, 'todos', 'todo');

			$scope.$watch('todos', function (todos, oldTodos) {
				$scope.remainingCount = 0;

				angular.forEach(todos, function(todo){
					if ( !todo.completed ) $scope.remainingCount++;
				});

				$scope.completedCount = todos.length - $scope.remainingCount;
				$scope.allChecked = !$scope.remainingCount;
			}, true);

			$scope.markAll = function() {
				angular.forEach($scope.todos, function(todo){
					todo.completed = !$scope.allChecked;
				});

				Platform.performMicrotaskCheckpoint();
			};

			$scope.clearCompleted = function() {
				for ( var i=0; i<$scope.todos.length; i++ ) {
					if ( $scope.todos[i].completed ) {
						$scope.todos.splice(i, 1);

						i--;
					}

					Platform.performMicrotaskCheckpoint();
				}
			};
		}
		]
	);

mangroveTodoApp
	.filter('statusFilter',
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
	.directive('todoEscape',
		function () {
			var ESCAPE_KEY = 27;
			return function (scope, elem, attrs) {
				elem.bind('keydown', function (event) {
					if (event.keyCode === ESCAPE_KEY) {
						scope.$apply(attrs.todoEscape);
					}
				});
			};
		}
	);

mangroveTodoApp
	.directive('todoFocus',
		function todoFocus($timeout) {
			return function (scope, elem, attrs) {
				scope.$watch(attrs.todoFocus, function (newVal) {
					if (newVal) {
						$timeout(function () {
							elem[0].focus();
						}, 0, false);
					}
				});
			};
		}
	);
