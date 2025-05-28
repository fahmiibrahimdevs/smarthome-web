<div>
    <section class="section">
        <div class="section-header tw-rounded-none lg:tw-rounded-lg tw-shadow-md tw-shadow-gray-300 px-4">
            <h1 class="tw-text-lg mb-1">Configure Feature</h1>
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
                    <h3>Table Feature</h3>
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
                                    <th width="18%">Nama Category</th>
                                    <th>Nama Feature</th>
                                    <th class="text-center">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->groupBy('id_categories') as $row)
                                <tr class="tw-tracking-wider">
                                    <td class="tw-font-bold" colspan="3">
                                        {{ $row[0]['name_category'] }}
                                    </td>
                                </tr>
                                @foreach ($row as $item)
                                <tr class="text-center">
                                    <td></td>
                                    <td class="text-left">{{ $item['name_feature'] }}</td>
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
                            <label for="id_categories">Name Category</label>
                            <div wire:ignore>
                                <select class="form-control tw-rounded-lg" name="id_categories" id="id_categories"
                                    wire:model='id_categories'>
                                    <option disabled>-- Pilih Opsi --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->uuid }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_categories') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="name_feature">Feature</label>
                            <input type="text" wire:model="name_feature" id="name_feature" class="form-control">
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
                            <label for="id_categories">Name Category</label>
                            <div wire:ignore>
                                <select class="form-control tw-rounded-lg" name="id_categories" id="edit-id_categories"
                                    wire:model='id_categories'>
                                    <option value="0" disabled>-- Pilih Opsi --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->uuid }}">{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_categories') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="name_feature">Feature</label>
                            <input type="text" wire:model="name_feature" id="name_feature" class="form-control">
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
        $('#id_categories').select2();
        $('#edit-id_categories').select2();

        $('#id_categories').on('change', function (e) {
            var data = $('#id_categories').select2("val");
            @this.set('id_categories', data);
        });
        $('#edit-id_categories').on('change', function (e) {
            var data = $('#edit-id_categories').select2("val");
            @this.set('id_categories', data);
        });
    });

</script>
@endpush
