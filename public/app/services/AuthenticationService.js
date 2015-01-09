angular.module('LaGetDep').factory('AuthenticationService', function ($http, UserModel) {
    return {
        attempt: function (username, password, success, error) {
            $http.post(laget_urls.api_laget + 'users/auth', {
                username: username,
                password: password
            }).success(function (data) {
                localStorage.setItem('authentication-token', data.token);
                $http.defaults.headers.common['X-Auth-Token'] = data.token;

                if (success) success(data.user);

            }).error(function (data) {
                if (error)error(data);
            });
        },
        setToken: function (token) {
            localStorage.setItem('authentication-token', token);
            $http.defaults.headers.common['X-Auth-Token'] = token;
        },
        resetToken: function () {
            localStorage.removeItem('authentication-token', null);
            $http.defaults.headers.common['X-Auth-Token'] = null;
        },
        setFromStorage: function () {
            this.setToken(localStorage.getItem('authentication-token'));
        },
        get: function (success, error) {
            UserModel.one().customGET('auth').then(success, error);
        },
        has: function () {
            return !!localStorage.getItem('authentication-token');
        },
        register: function (userData, success, error) {
            UserModel.post(userData).then(success, error);
        }
    };
});
