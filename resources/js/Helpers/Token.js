class Token {

    isValid(token) {
        const payload = this.payload(token);
        if (payload.iss === 'http://localhost:8000/api/auth/login' || 'http://localhost:8000/api/auth/register') {
            return true;
        }
        return false;
    }

    payload(token) {
        const payload = token.split('.')[1];
        return this.decode(payload);
    }
    
    decode(payload) {
        return atob(payload);
    }
}

export default new Token();