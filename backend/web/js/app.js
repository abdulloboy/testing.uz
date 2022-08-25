Vue.createApp({
    data() {
        return {
            answers: []
        }
    },
    mounted() {
    },
    methods: {
        addAnswer() {
            answers.push('');
        }
    }
}).mount('#task-form') 