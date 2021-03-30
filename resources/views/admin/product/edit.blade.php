<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('admin.products.update', $product->id)}}" method="post"
                                      enctype="multipart/form-data"
                                      multiple>
                                    @csrf
                                    @method('PATCH')
                                    {{-- Form include --}}
                                    @include('admin.product.partials.form')
                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
