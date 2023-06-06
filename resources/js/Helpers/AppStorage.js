class AppStorage {
    
    storeToken(token) {
        localStorage.setItem('token', token);
    }

    storeUser(user) {
        localStorage.setItem('user', user);
    }

    store(token, user) {
        this.storeToken(token);
        this.storeUser(user);
    }

    getToken() {
        localStorage.getItem('token');
    }

    getUser() {
        localStorage.getItem('user');
    }

    clearAuthData() {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }
}

export default new AppStorage();