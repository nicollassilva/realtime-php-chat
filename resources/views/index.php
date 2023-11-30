<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/app.js"></script>
</head>
<body class="bg-slate-200 flex justify-center items-center w-screen h-screen p-8">
    <div class="bg-white rounded-lg w-full h-full shadow border border-slate-300" x-data="chat">
        <div class="bg-slate-300 text-white px-4 py-2 flex justify-between items-center">
            <h1 class="font-bold">Chat</h1>
        </div>
        <div class="px-4 py-2 h-5/6 overflow-y-scroll flex flex-col gap-2">
            <template x-for="message in messages" :key="message.id">
                <div
                    class="p-2 border border-slate-100 rounded-lg"
                    :class="{ 'text-green-500': message.type == 'success', 'text-red-500': message.type == 'error' }"
                >
                    <i
                        class="fa-solid"
                        :class="{ 'fa-check': message.type == 'success', 'fa-xmark': message.type == 'error' }"
                    ></i>
                    <span
                        :class="{ 'font-semibold': message.type != 'message' }"
                        x-text="message.content"
                    ></span>
                </div>
            </template>
        </div>
        <div class="px-4 py-2">
            <form @submit.prevent="send">
                <input
                    :disabled="inputDisabled"
                    type="text"
                    class="border border-slate-300 rounded-lg w-full px-4 py-2"
                    placeholder="Message"
                    x-model="messageModel"
                >
            </form>
        </div>
    </div>
</body>
</html>