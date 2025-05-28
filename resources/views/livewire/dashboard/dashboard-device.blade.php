<div>
    <section class="section">
        <div class="tw-px-0 lg:tw-px-5">
            <div class="section-header tw-rounded-none lg:tw-rounded-lg tw-shadow-md tw-shadow-gray-300 px-4">
                <h1 class="tw-text-lg mb-1">Smart Learning</h1>
            </div>
        </div>

        <div class="section-body tw-mt-5 tw-px-5">
            <div class="tw-mb-3 tw-text-sm text-black tw-font-bold">
                <p>4 Class Available</p>
            </div>
            <div
                class="tw-flex tw-overflow-x-scroll tw-space-x-4 scrollbar-hide tw-mt-4"
            >
                @foreach ($rooms as $room)
                <a
                    href="{{ url('dashboard-devices/'.$room->uuid) }}"
                    class="tw-no-underline"
                >
                    <div
                        class="card tw-rounded-lg tw-w-auto tw-flex-shrink-0 hover:tw-text-gray-700"
                    >
                        <div class="card-body tw-px-5 tw-py-3 lg:tw-py-5">
                            @if ($room->uuid == $uuid)
                            <div class="tw-flex">
                                <i
                                    class="fas fa-podium-star tw-text-2xl tw-mt-1 tw-text-blue-800"
                                ></i>
                                <div class="tw-text-blue-800">
                                    <p
                                        class="tw-ml-4 tw-text-sm tw-overflow-hidden tw-whitespace-nowrap"
                                    >
                                        {{ $room->name_room }}
                                    </p>
                                    <p class="tw-ml-4">
                                        {{ $room->available_devices }} Devices
                                    </p>
                                </div>
                            </div>
                            @else
                            <div class="tw-flex">
                                <i
                                    class="fas fa-podium-star tw-text-2xl tw-mt-1 tw-text-grey-700"
                                ></i>
                                <div class="tw-text-grey-700">
                                    <p
                                        class="tw-ml-4 tw-text-sm tw-overflow-hidden tw-whitespace-nowrap"
                                    >
                                        {{ $room->name_room }}
                                    </p>
                                    <p class="tw-ml-4">
                                        {{ $room->available_devices }} Devices
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <p class="tw-mb-3 tw-text-sm">Power Monitoring</p>
                    <div class="card tw-rounded-lg">
                        <div class="card-body tw-px-5 tw-py-3 lg:tw-py-5">
                            <div class="row tw-text-center">
                                <div class="col-4">
                                    <p class="tw-text-black tw-text-[12px] lg:tw-text-sm">
                                        Voltage
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p class="tw-text-black tw-text-[12px] lg:tw-text-sm">
                                        Current
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p class="tw-text-black tw-text-[12px] lg:tw-text-sm">
                                        Power
                                    </p>
                                </div>
                                <div
                                    class="col-4 tw-mt-1 tw-mb-0 lg:tw-mt-3 lg:tw-mb-1"
                                >
                                    <p
                                        class="tw-text-[13px] lg:tw-text-xl tw-text-black tw-font-semibold"
                                        style="
                                            font-family: 'Chakra Petch',
                                                sans-serif;
                                        "
                                    >
                                        230.50 V
                                    </p>
                                </div>
                                <div
                                    class="col-4 tw-mt-1 tw-mb-0 lg:tw-mt-3 lg:tw-mb-2"
                                >
                                    <p
                                        class="tw-text-[13px] lg:tw-text-xl tw-text-black tw-font-semibold"
                                        style="
                                            font-family: 'Chakra Petch',
                                                sans-serif;
                                        "
                                    >
                                        30.10 A
                                    </p>
                                </div>
                                <div
                                    class="col-4 tw-mt-1 tw-mb-0 lg:tw-mt-3 lg:tw-mb-2"
                                >
                                    <p
                                        class="tw-text-[13px] lg:tw-text-xl tw-text-black tw-font-semibold"
                                        style="
                                            font-family: 'Chakra Petch',
                                                sans-serif;
                                        "
                                    >
                                        3128.00 W
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="tw-mb-3 tw-mt-0 lg:tw-mt-10 tw-text-sm">Remote Curtain</p>
                    <div class="card tw-rounded-lg">
                        <div class="card-body tw-px-5 tw-py-4 lg:tw-py-5">
                            <div class="tw-grid tw-grid-cols-3 tw-text-center">
                                <div>
                                    <button class="btn btn-transparent">
                                        <p class="tw-text-base lg:tw-text-xl">START</p>
                                    </button>
                                </div>
                                <div>
                                    <button class="btn btn-transparent">
                                        <p class="tw-text-base lg:tw-text-xl">BACK</p>
                                    </button>
                                </div>
                                <div>
                                    <button class="btn btn-transparent">
                                        <p class="tw-text-base lg:tw-text-xl">OFF</p>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="tw-mb-3 tw-text-sm">Remote AC</p>
                    <div class="card tw-rounded-lg">
                        <div class="card-body tw-text-center">
                            <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-place-content-around tw-text-black">
                                <div><p class="tw-text-xs lg:tw-text-sm">Temp Room</p></div>
                                <div><p class="tw-text-xs lg:tw-text-sm">Humidity</p></div>
                                <div class="tw-font-bold tw-text-sm lg:tw-text-lg tw-mt-[-10px]">30°C</div>
                                <div class="tw-font-bold tw-text-sm lg:tw-text-lg tw-mt-[-10px]">57%</div>
                            </div>
                            <p class="tw-text-black tw-font-extrabold tw-text-2xl lg:tw-text-4xl tw-mt-5">26</p>
                            <p class="tw-text-black tw-font-medium tw-text-xs tw-mt-2">SET TEMPERATURE</p>
                            <div class="tw-grid tw-grid-cols-3 tw-mt-10">
                                <button class="btn btn-transparent">
                                    <i class="fas fa-plus tw-text-xl lg:tw-text-2xl tw-font-medium"></i>
                                </button>
                                <button class="btn btn-transparent">
                                    <i class="fas fa-power-off tw-text-xl lg:tw-text-2xl tw-font-medium"></i>
                                </button>
                                <button class="btn btn-transparent">
                                    <i class="fas fa-minus tw-text-xl lg:tw-text-2xl tw-font-medium"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="tw-mb-4 tw-mt-2 tw-text-sm tw-text-black tw-font-semibold"
            >
                <p>Connected Devices</p>
            </div>
            <div
                class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-6 tw-gap-4 lg:tw-gap-4"
                id="data-card-power"
            ></div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    let _devicesData = [];
    let hostMQTT;
    let portMQTT;
    let userMQTT;
    let passMQTT;
    var dataCount;
    var lampu = [];
    let payload;
</script>
<script>
    $(document).ready(function () {
        fetchDataMQTT();
        setTimeout(() => {
            fetchDataDevices();
        }, 250);
    });
</script>
<script>
    function startConnect() {
        clientID = "client_ind" + parseInt(Math.random() * 100);
        host = hostMQTT;
        port = portMQTT;
        client = new Paho.MQTT.Client(host, Number(port), clientID);
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        client.connect({
            onSuccess: onConnect,
            userName: userMQTT,
            password: passMQTT,
        });
    }

    function onConnect() {
        for (let i = 0; i < _devicesData.length; i++) {
            subscribe(_devicesData[i]["topic"]);
        }
        console.log("Connected MQTT!");
    }

    function subscribe(topic) {
        client.subscribe(topic);
    }

    function publish(topic, message) {
        message = new Paho.MQTT.Message(message);
        message.destinationName = topic;
        message.retained = true;
        client.send(message);
    }

    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("Connection Lost: " + responseObject.errorMessage);
        }
    }

    function onMessageArrived(message) {
        console.log("Message Received: " + message.payloadString);
        for (let i = 0; i < _devicesData.length; i++) {
            if (message.destinationName == _devicesData[i]["topic"]) {
                payload = message.payloadString;
                if (payload == _devicesData[i]["active"]) {
                    lampu[i] = true;
                    $(`#power-${i}`).prop("checked", true);
                } else if (payload == _devicesData[i]["inactive"]) {
                    lampu[i] = false;
                    $(`#power-${i}`).prop("checked", false);
                }
            }
        }
    }

    function startDisconnect() {
        client.disconnect();
        alert("Disconnect MQTT");
    }
</script>
<script>
    function fetchDataMQTT() {
        $.ajax({
            type: "GET",
            url: "/api/mqtt",
            success: function (res) {
                hostMQTT = res[0]["host"];
                portMQTT = res[0]["port"];
                userMQTT = res[0]["username"];
                passMQTT = res[0]["password"];
            },
        });
    }
</script>
<script>
    function fetchDataDevices() {
        $.ajax({
            type: "GET",
            url: "/api/device/{{ $uuid }}/power",
            success: function (res) {
                _devicesData = res;
                for (let i = 0; i < _devicesData.length; i++) {
                    lampu[i] = false;
                }
                startConnect();
                setTimeout(() => {
                    for (let i = 0; i < _devicesData.length; i++) {
                        $("#data-card-power").append(
                            '<div class="card tw-rounded-xl tw-mb-0">' +
                                '<div class="card-body tw-py-3 tw-px-4 lg:tw-px-5 lg:tw-py-5">' +
                                '<div class="tw-flex">' +
                                '<i class="far fa-lightbulb tw-text-2xl lg:tw-text-3xl tw-text-blue-800"></i>' +
                                '<label class="switch tw-ml-auto">' +
                                `<input type="checkbox" ${
                                    lampu[i] ? "checked" : ""
                                } id="power-${i}" onchange="toggleSwitch(this)" data-topic="${
                                    _devicesData[i]["topic"]
                                }" data-active="${
                                    _devicesData[i]["active"]
                                }" data-inactive="${
                                    _devicesData[i]["inactive"]
                                }">` +
                                '<span class="slider round"></span>' +
                                "</label>" +
                                "</div>" +
                                '<div class="tw-mt-3 ">' +
                                `<p class="tw-text-[15px] lg:tw-text-base tw-text-black">${_devicesData[i]["name_device"]}</p>` +
                                '<p class="tw-text-sm tw-text-grey-800">On</p>' +
                                "</div>" +
                                "</div>" +
                                "</div>"
                        );
                    }
                }, 1500);
            },
        });
    }
</script>
<script>
    function toggleSwitch(checkbox) {
        console.log();
        var status;
        var topic;
        var active;
        var inactive;

        status = $(checkbox).is(":checked");
        topic = $(checkbox).data("topic");
        active = $(checkbox).data("active");
        inactive = $(checkbox).data("inactive");

        if (status === true) {
            publish(topic, active);
        } else if (status === false) {
            publish(topic, inactive);
        }
    }
</script>
@endpush
