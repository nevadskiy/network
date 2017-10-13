export default {
    data() {
        return {
            inputData: '',
            isValidError: false,
        }
    },
    computed: {
        lengthValidation() {
            return 'Left : ' + (255 -this.inputData.length);
        },
        hasError() {
            return (this.isValidError && this.disabled) || this.inputData.length > 255;
        },
        disabled() {
            return this.inputData.length < 1 || this.inputData.length > 255;
        },
    }
}