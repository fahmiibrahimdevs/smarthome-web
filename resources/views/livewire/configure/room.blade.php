<div>
    <section class="section">
        <div class="section-header tw-rounded-none lg:tw-rounded-lg tw-shadow-md tw-shadow-gray-300 px-4">
            <h1 class="tw-text-lg mb-1">Configure Room</h1>
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
                    <h3>Table Room</h3>
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
                    <div class="table-responsive tw-max-h-96">
                        <table>
                            <thead class="tw-sticky tw-top-0">
                                <tr class="tw-text-gray-700">
                                    <th width="18%">Name Location</th>
                                    <th>Name Room</th>
                                    <th class="text-center">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->groupBy('id_location') as $row)
                                <tr class="tw-tracking-wider">
                                    <td class="tw-font-bold" colspan="3">
                                        {{ $row[0]['name_location'] }}
                                    </td>
                                </tr>
                                @foreach ($row as $item)
                                <tr class="text-center">
                                    <td></td>
                                    <td class="text-left">{{ $item['name_room'] }}</td>
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
                        <div class="form-group">
                            <label for="id_location">Location</label>
                            <div wire:ignore>
                                <select wire:model="id_location" id="id_location" class="form-control tw-rounded-lg">
                                    <option disabled>-- Select Option --</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->uuid }}">{{ $location->name_location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name_room">Room</label>
                            <input type="text" wire:model="name_room" id="name_room" class="form-control">
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
                        <div class="form-group">
                            <label for="id_location">Location</label>
                            <div wire:ignore>
                                <select wire:model="id_location" id="edit-id_location"
                                    class="form-control tw-rounded-lg">
                                    <option disabled>-- Select Option --</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->uuid }}">{{ $location->name_location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name_room">Room</label>
                            <input type="text" wire:model="name_room" id="name_room" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary tw-bg-gray-300"
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
        $('#id_location').select2();
        $('#edit-id_location').select2();

        $('#id_location').on('change', function (e) {
            var data = $('#id_location').select2("val");
            @this.set('id_location', data);
        });
        $('#edit-id_location').on('change', function (e) {
            var data = $('#edit-id_location').select2("val");
            @this.set('id_location', data);
        });
    });

</script>
@endpush
