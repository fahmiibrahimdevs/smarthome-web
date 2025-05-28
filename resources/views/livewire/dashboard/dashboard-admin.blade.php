<div>
    <section class="section">
        <div class="tw-px-0 lg:tw-px-5">
            <div class="section-header tw-rounded-none lg:tw-rounded-lg tw-shadow-md tw-shadow-gray-300 px-4">
                <h1 class="tw-text-lg mb-1">Smart Learning</h1>
            </div>
        </div>

        <div class="section-body tw-mt-5 tw-px-5">
            <div class="tw-mb-3 tw-text-sm tw-text-black tw-font-bold">
                <p>4 Class Available</p>
            </div>
            <div class="tw-flex tw-overflow-x-scroll tw-space-x-4 scrollbar-hide tw-mt-4">
                @foreach ($rooms as $room)
                <a href="{{ url('dashboard-devices/'.$room->uuid) }}" class="tw-no-underline">
                    <div class="card tw-rounded-xl tw-flex-shrink-0 tw-w-auto">
                        <div class="card-body">
                            <div class="tw-flex">
                                <i class="fas fa-podium-star tw-text-3xl tw-mt-1 tw-text-gray-700"></i>
                                <div class="tw-text-gray-700">
                                    <p class="tw-ml-4 tw-text-sm tw-overflow-hidden tw-whitespace-nowrap">{{ $room->name_room }}</p>
                                    <span class="tw-ml-4">{{ $room->available_devices }} Devices</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            {{-- <div class="tw-mb-4 tw-mt-3 tw-text-sm tw-text-black tw-font-semibold">
                <p>Connected Devices</p>
            </div>
            <div class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-4 lg:tw-gap-8">
                <div class="card tw-rounded-xl tw-mb-0">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-lightbulb tw-text-3xl tw-text-blue-800"></i>
                            <label class="switch tw-ml-auto">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="tw-mt-3 ">
                            <p class="tw-text-[15px] lg:tw-text-base tw-text-black">Lampu Depan</p>
                            <p class="tw-text-sm tw-text-grey-800">On</p>
                        </div>
                    </div>
                </div>
                <div class="card tw-rounded-xl tw-mb-0">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-lightbulb tw-text-3xl tw-text-blue-800"></i>
                            <label class="switch tw-ml-auto">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="tw-mt-3 ">
                            <p class="tw-text-[15px] lg:tw-text-base tw-text-black">Lampu Depan</p>
                            <p class="tw-text-sm tw-text-grey-800">On</p>
                        </div>
                    </div>
                </div>
                <div class="card tw-rounded-xl tw-mb-0">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-lightbulb tw-text-3xl tw-text-blue-800"></i>
                            <label class="switch tw-ml-auto">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="tw-mt-3 ">
                            <p class="tw-text-[15px] lg:tw-text-base tw-text-black">Lampu Depan</p>
                            <p class="tw-text-sm tw-text-grey-800">On</p>
                        </div>
                    </div>
                </div>
                <div class="card tw-rounded-xl tw-mb-0">
                    <div class="card-body">
                        <div class="tw-flex">
                            <i class="far fa-lightbulb tw-text-3xl tw-text-blue-800"></i>
                            <label class="switch tw-ml-auto">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="tw-mt-3 ">
                            <p class="tw-text-[15px] lg:tw-text-base tw-text-black">Lampu Depan</p>
                            <p class="tw-text-sm tw-text-grey-800">On</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
</div>
