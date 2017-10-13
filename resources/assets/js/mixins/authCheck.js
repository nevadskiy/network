export default {
    methods: {
        authCheck() {
            if (!window.App.isSignedIn) {
            	console.log('singed');
                window.location = "/login";
                return false;
            }
            return true;
        }
    }
}