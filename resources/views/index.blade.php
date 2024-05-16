<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('assets/img/logo-um-minified.png') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <title>UMMIA (UM Metro Intellegent Assistance)</title>
    <style>
        #chatbox {
            position: absolute;
            bottom: 0;
            right: 3rem;
            width: 23vw;
            /* height: calc(100vh-50%); */
        }

        #chat-wrapper {
            height: 15rem;
        }

        @media (max-width: 600px) {
            #chatbox {
                right: 3rem;
                width: 80vw;
                /* height: calc(100vh-50%); */
            }

            #chat-wrapper {
                height: 15rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-4">
        <div class="text-center">
            <div class="mb-3 w-100">
                <img src="{{ asset('assets/img/logo-um.png') }}" width="25%" alt="">
            </div>
            <h2 class="h2">UMMIA (UM Metro Intellegent Assistance)</h2>
            <div class="my-3">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="collapse"
                    data-bs-target="#chatbox" aria-expanded="false" aria-controls="chatbox">
                    <span class="bi bi-chat"></span>
                    Tanya UMI
                </button>
            </div>
        </div>

        <div class="collapse" id="chatbox">
            <div class="card">
                <div class="card-header text-white" style="background: #0a0a7a;">
                    <div class="d-flex gap-2 justify-content-between fw-bold py-1">
                        <img class="" src="{{ asset('assets/img/logo-um-minified.png') }}" width="20%"
                            height="100%" alt="Logo UM Metro">
                        <div class="text-nowrap">
                            <div style="font-size: 1.2rem;">UM Metro</div>
                            <div style="font-size: .9rem;">Intellegent Assistance</div>
                        </div>
                        {{-- <div class="d-flex align-items-start justify-content-end"> --}}
                        <button type="button" class="position-relative btn btn-sm text-white shadow-none py-0 px-3"
                            style="bottom: 1rem; left: 1.5rem;" data-bs-toggle="collapse" data-bs-target="#chatbox">
                            <span class="bi bi-x" style="font-size: 1.5rem"></span>
                        </button>
                        {{-- </div> --}}
                    </div>
                </div>


                <div class="card-body m- px-0">
                    <div id="chat-wrapper" class="overflow-y-auto px-3">
                        <div class=" d-flex gap-3 flex-column justify-content-end align-items-baseline" id="chat">
                            <div class="talk-bubble tri-right rounded-2 left-in">
                                <div>
                                    Halo, ada yang bisa saya bantu?
                                    Gunakan bahasa Indonesia yang baik dan benar.
                                </div>
                                <div class="chat-time" id="initial-time">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card-footer shadow" style="border-top: 1px solid rgb(165, 165, 165)">
                    <div class="d-flex align-items-center justify-content-between gap-1">
                        <input type="text" name="message" id="message" class="form-control border-2"
                            style="border-color: gray" placeholder="Type message..." autofocus>
                        <button type="button" class="btn btn-sm shadow-none" onclick="send()">
                            <span class="bi bi-send fs-5"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const options = {
            minimumIntegerDigits: 2,
            useGrouping: false
        }

        $(document).ready(function() {
            const html = getTimeStamp();
            $('#initial-time').html(html);
        })

        function reply() {
            const time = getTimeStamp();
            const message =
                'Saat ini sistem sedang dalam tahap pengembangan, silakan kunjungi web <a href="https://penmaru.ummetro.ac.id" target="__blank">penmaru.ummetro.ac.id</a> untuk informasi pendaftaran'
            const html = `<div class="talk-bubble tri-right rounded-2 left-in">
                                <div>
                                    ${message}
                                </div>
                                <div class="chat-time">
                                    ${time}
                                </div>
                            </div>`;
            $('#chat').append(html);
            scrollBottom();
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
                            </div>`
            $('#chat').append(html)
            $('#message').val('');
            scrollBottom();
            setTimeout(() => {
                reply();
            }, 700);

        }

        $(document).on('keypress', function(e) {
            if (e.which == 13) {
                send();
            }
        });

        function scrollBottom() {
            $('#chat-wrapper').animate({
                scrollTop: $('#chat-wrapper').height()
            }, 700);
        }

        function getTimeStamp() {
            const date = new Date();
            const time =
                `${date.getDate()}/${date.getMonth()}/${date.getFullYear()} ${date.getHours()}:${date.getMinutes().toLocaleString('id-ID', options)}`;

            return time;
        }
    </script>
</body>

</html>
