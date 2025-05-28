<div>
    <section class="section">
        <div class="section-header tw-rounded-none lg:tw-rounded-lg tw-shadow-md tw-shadow-gray-300 px-4">
            <h1 class="tw-text-lg mb-1">Configure MQTT</h1>
        </div>

        @if ($errors->any())
        <script>
            Swal.fire(
                'error',
                'Ada yang error',
                'error'
            )

        </script>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body px-0">
                            <h3>Authenticated MQTT</h3>
                            <form class="tw-mx-5">
                                <div class="form-group">
                                    <label for="host">Host</label>
                                    <input type="text" class="form-control tw-rounded-lg" name="host" id="host"
                                        wire:model='host'>
                                    @error('host') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control tw-rounded-lg" name="username"
                                                id="username" wire:model='username'>
                                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control tw-rounded-lg" name="password"
                                                id="password" wire:model='password'>
                                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="port">Port</label>
                                    <input type="number" class="form-control tw-rounded-lg" min="0" name="port"
                                        id="port" wire:model='port'>
                                    @error('port') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="float-right">
                                    <button type="submit" wire:click.prevent="update()" wire:loading.attr="disabled"
                                        class="btn btn-primary tw-bg-blue-500 ">Save Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
