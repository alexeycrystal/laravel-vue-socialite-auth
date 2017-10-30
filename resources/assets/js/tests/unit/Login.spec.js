import Vue from 'vue'
import Login from '../../views/Auth/Login.vue';

describe("Login.vue component", function() {
    it('Component has a created action', () => {
        expect(typeof Login.created).toBe('function');
    });

    it('Component should have data', function () {
        expect(typeof Login.data).toBe('function');
    });

    it('Component sets the correct default data', () => {
        const defaultData = Login.data();
        expect(defaultData.form).toEqual({email:'', password:''});
        expect(defaultData.isProcessing).toBeFalsy();
        expect(defaultData.error).toEqual({});
    });

    it('Component should contain login method', function () {
        expect(typeof Login.methods.login).toBe('function');
    });

    it('Component should contain socialLogin method', function () {
        expect(typeof Login.methods.socialLogin).toBe('function');
    });
});