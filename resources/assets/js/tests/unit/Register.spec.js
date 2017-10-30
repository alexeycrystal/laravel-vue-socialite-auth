import Vue from 'vue'
import Register from '../../views/Auth/Register.vue';

describe("Register.vue component", function() {
    it('Component should have data', function () {
        expect(typeof Register.data).toBe('function');
    });

    it('Component sets the correct default data', () => {
        const defaultData = Register.data();
        expect(defaultData.form).toEqual({name:'', email:'', password:'', password_confirmation: ''});
        expect(defaultData.isProcessing).toBeFalsy();
        expect(defaultData.error).toEqual({});
    });

    it('Component should contain register method', function () {
        expect(typeof Register.methods.register).toBe('function');
    });
});