import Vue from 'vue'
import Editor from '../../views/Auth/Login.vue';

describe('Editor', () => {
    it('should set correct default data', function () {
        expect(typeof Editor.data).toBe('function');
        var defaultData = Editor.data();
        expect(defaultData.input).toBe('# Hello!');
    });
});