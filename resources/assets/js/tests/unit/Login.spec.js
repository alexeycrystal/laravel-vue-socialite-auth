import axios from 'axios';
import MockAdapter from 'axios-mock-adapter';
import Vue from 'vue';
import Login from '../../views/Auth/Login.vue';

const mockAxios = new MockAdapter(axios);

describe("Login.vue component", function() {
    it('Component has a created action', () => {
        expect(typeof Login.created).toBe('function');
    });

    it('Component should have data', function () {
        expect(typeof Login.data).toBe('function');
    });

    it('Component sets the correct default data', () => {
        var defaultData = Login.data();
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

    it('Component login method mocking ',function(){
        var authenticated = true;
        var api_token = 'tokenauthexamplechecktrue';
        var user_id = '1';
        mockAxios.onPost('/api/login').reply(200, {
            'authenticated': authenticated,
            'api_token': api_token,
            'user_id': user_id
        });
        Login.methods.login();
        var data = Login.data();
        console.log(data.auth);
        expect(typeof data.auth).toBe('object');
        expect(typeof data.status).toBe('object');
        expect(data.status.state.success).toEqual('You have successfully logged in!');
        mockAxios.reset();
    });
});