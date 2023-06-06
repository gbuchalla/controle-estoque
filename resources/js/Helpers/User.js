import Token from './Token'
import AppStorage from './AppStorage'

class User {

    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const email = JSON.parse(res.config.data).email;
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, email)
        }
    }


    hasToken() {
        const storeToken = localStorage.getItem('token');
        if (storeToken) {
            return Token.isValid(storeToken) ? true : false;
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    name() {
        if (this.loggedIn()) {
            return localStorage.getItem('user');
        }
    }


    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(localStorage.getItem('token'));
            return payload.sub;
        }
        return false
    }



}

export default new User();