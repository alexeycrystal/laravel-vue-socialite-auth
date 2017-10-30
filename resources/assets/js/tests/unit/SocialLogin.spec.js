import Vue from 'vue'
import SocialLogin from '../../views/Auth/SocialLogin.vue';

describe("SocialLogin.vue component", function() {
    it('Component sets the correct default data', () => {
        const defaultData = SocialLogin.data();
        expect(defaultData.form).toEqual({email:'', password:''});
    });
});