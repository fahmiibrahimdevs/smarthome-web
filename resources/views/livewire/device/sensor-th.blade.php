<div>
    <section class="section">
        <div class="section-header tw-rounded-none lg:tw-rounded-lg tw-shadow-md tw-shadow-gray-300 px-4">
            <h1 class="tw-text-lg mb-1">Configure Device - SENSOR TH</h1>
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
            <div class="card">
                <div class="card-body px-0">
                    <h3>Table Device - SENSOR TH</h3>
                    <div class="show-entries">
                        <p class="show-entries-show">Show</p>
                        <select wire:model='lengthData' id="length-data">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <p class="show-entries-entries">Entries</p>
                    </div>
                    <div class="search-column">
                        <p>Search: </p>
                        <input type="search" wire:model.debounce.1s='search' id="search-data"
                            placeholder="Search here...">
                    </div>
                    <div class="table-responsive tw-max-h-[500px]">
                        <table>
                            <thead class="tw-sticky tw-top-0">
                                <tr class="tw-text-gray-700 text-center">
                                    <th width="15%">Name Room</th>
                                    <th>Features</th>
                                    <th>Name Device</th>
                                    <th>Topic</th>
                                    <th class="text-center">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $data->groupBy('name_room') as $row )
                                <tr class="tw-tracking-wider">
                                    <td class="tw-font-bold" colspan="4">
                                        {{ $row[0]['name_room'] }}
                                    </td>
                                </tr>
                                @foreach ( $row as $item )
                                <tr class="text-center">
                                    <td></td>
                                    <td class="text-left">{{ $item['name_feature'] }}</td>
                                    <td class="text-left">{{ $item['name_device'] }}</td>
                                    <td class="text-left">{{ $item['topic'] }}</td>
                                    <td>
                                        <button class="btn btn-primary" wire:click='edit({{ $item['id'] }})'
                                            data-toggle="modal" data-target="#ubahDataModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger"
                                            wire:click.prevent='deleteConfirm({{ $item['id'] }})'>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 table-responsive tw-mb-[-15px]">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
        <button class="btn-modal" data-toggle="modal" data-target="#tambahDataModal">
            <i class="far fa-plus"></i>
        </button>
    </section>

    <div class="modal fade" wire:ignore.self id="tambahDataModal" aria-labelledby="tambahDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="id_room">ROOM</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="id_room" id="id_room"
                                            wire:model='id_room'>
                                            @foreach ($rooms as $room)
                                            <option value="{{ $room->uuid }}" selected>{{ $room->name_room }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_room') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="id_feature">Feature</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="id_feature" id="id_feature"
                                            wire:model='id_feature'>
                                            @foreach ($features as $feature)
                                            <option value="{{ $feature->uuid }}" selected>{{ $feature->name_feature }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_feature') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name_device">Name Device</label>
                            <input type="text" class="form-control tw-rounded-lg" name="name_device" id="name_device"
                                wire:model='name_device'>
                            @error('name_device') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="topic">Topic</label>
                            <input type="text" class="form-control tw-rounded-lg" name="topic" id="topic"
                                wire:model='topic'>
                            @error('topic') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary tw-bg-gray-300"
                            data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="store()" wire:loading.attr="disabled"
                            class="btn btn-primary tw-bg-blue-500">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="ubahDataModal" aria-labelledby="ubahDataModalLabel" aria-hidden="true"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataModalLabel">Edit Data</h5>
                    <button type="button" wire:click.prevent='cancel()' class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" wire:model='dataId'>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="id_room">ROOM</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="id_room" id="edit-id_room"
                                            wire:model='id_room'>
                                            @foreach ($rooms as $room)
                                            <option value="{{ $room->uuid }}" selected>{{ $room->name_room }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_room') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="id_feature">Feature</label>
                                    <div wire:ignore>
                                        <select class="form-control tw-rounded-lg" name="id_feature" id="edit-id_feature"
                                            wire:model='id_feature'>
                                            @foreach ($features as $feature)
                                            <option value="{{ $feature->uuid }}" selected>{{ $feature->name_feature }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_feature') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name_device">Name Device</label>
                            <input type="text" class="form-control tw-rounded-lg" name="name_device" id="name_device"
                                wire:model='name_device'>
                            @error('name_device') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="topic">Topic</label>
                            <input type="text" class="form-control tw-rounded-lg" name="topic" id="topic"
                                wire:model='topic'>
                            @error('topic') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary tw-bg-gray-300"
                            data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="update()" wire:loading.attr="disabled"
                            class="btn btn-primary tw-bg-blue-500">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#id_room').select2();
        $('#id_feature').select2();
        $('#retain').select2();

        $('#edit-id_room').select2();
        $('#edit-id_feature').select2();
        $('#edit-retain').select2();

        $('#id_room').on('change', function (e) {
            var data = $('#id_room').select2("val");
            @this.set('id_room', data);
        });
        $('#edit-id_room').on('change', function (e) {
            var data = $('#edit-id_room').select2("val");
            @this.set('id_room', data);
        });
        $('#id_feature').on('change', function (e) {
            var data = $('#id_feature').select2("val");
            @this.set('id_feature', data);
        });
        $('#edit-id_feature').on('change', function (e) {
            var data = $('#edit-id_feature').select2("val");
            @this.set('id_feature', data);
        });
        $('#retain').on('change', function (e) {
            var data = $('#retain').select2("val");
            @this.set('retain', data);
        });
        $('#edit-retain').on('change', function (e) {
            var data = $('#edit-retain').select2("val");
            @this.set('retain', data);
        });
    });

</script>
@endpush
