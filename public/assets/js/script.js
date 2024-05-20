function scrollBottom() {
   console.log($('#chat').height());
   $('#chat-wrapper').animate(
      {
         scrollTop: $(
            '#chat'
         ).height(),
      },
      700
   );
}

function getTimeStamp() {
   const date = new Date();
   const time = `${date.getDate()}/${date.getMonth()}/${date.getFullYear()} ${date.getHours()}:${date
      .getMinutes()
      .toLocaleString('id-ID', options)}`;

   return time;
}

function reply(message) {
   const time = getTimeStamp();
   const response = predictResponse(message);
   const html = `<div class="talk-bubble tri-right rounded-2 left-in">
                                <div>
                                    ${response}
                                </div>
                                <div class="chat-time">
                                    ${time}
                                </div>
                            </div>`;
   $('#chat').append(html);
   scrollBottom();
}

function askingAdrress(prompt) {
   return (prompt.includes('alamat') || prompt.includes('dimana') || prompt.includes('tempat') || prompt.includes('lokasi'));
}

function predictResponse(message) {
   if (askingAdrress(message.toLowerCase())) {
      return 'Kampus UM Metro berlokasi di Jl. Ki Hajar Dewantara No.116, Iringmulyo, Kec. Metro Tim. Kota Metro Lampung'
   }
   return 'Mohon maaf saya belum bisa menjawab pertanyaan anda. Saat ini saya sedang dalam tahap pengembangan untuk dapat memahami lebih banyak pertanyaan. Untuk info lebih lanjut dapat diakses melalui <a href="https://penmaru.ummetro.ac.id" target="__blank">penmaru.ummetro.ac.id</a>';
}

function send() {
   const message = $('#message').val();
   if (message === '') {
      return;
   }
   const time = getTimeStamp();

   const html = `<div class="talk-bubble tri-right rounded-2 right-top ms-auto">
                                <div>
                                    ${message}
                                </div>
                                <div class="chat-time" id="initial-time">
                                    ${time}
                                </div>
                            </div>`;
   $('#chat').append(html);
   $('#message').val('');
   scrollBottom();
   setTimeout(() => {
      reply(message);
   }, 700);
}