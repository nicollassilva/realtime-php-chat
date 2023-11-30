document.addEventListener('alpine:init', () => {
    Alpine.data('chat', () => ({
        messages: [],
        connection: null,
        messageModel: '',
        inputDisabled: true,

        init() {
            if(this.connection instanceof WebSocket) return;

            this.connection = new WebSocket('ws://localhost:8080');
            
            this.connection.onopen = this.onOpen.bind(this);
            this.connection.onmessage = this.onMessage.bind(this);
            this.connection.onerror = this.onError.bind(this);
        },

        onOpen() {
            this.messages.push({
                id: Math.random().toString(36),
                type: 'success',
                content: 'Connected to the chat server!'
            });

            this.inputDisabled = false;
        },

        onMessage(event) {
            const message = JSON.parse(event.data);
            
            this.messages.push(message);
        },

        onError(event) {
            this.messages.push({
                id: Math.random().toString(36),
                type: 'error',
                content: 'An error ocurred while connecting to the chat server.'
            })
        },

        send(event) {
            event.preventDefault();

            if(!this.messageModel.length) return;

            const message = {
                id: Math.random().toString(36),
                type: 'message',
                content: this.messageModel
            }

            this.connection.send(JSON.stringify(message));

            this.messageModel = '';
        }
    }))
})