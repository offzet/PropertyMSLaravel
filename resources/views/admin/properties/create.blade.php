<!-- resources/views/admin/properties/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Property') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Property Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Property Name *</label>
                                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Property Code (Auto-generated) -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">Property Code</label>
                                <input type="text" name="code" id="code" value="{{ $propertyCode ?? old('code') }}"
                                       class="mt-1 block w-full border border-gray-300 bg-gray-100 rounded-md shadow-sm p-2 cursor-not-allowed"
                                       readonly placeholder="Auto-generated">
                                <p class="text-xs text-gray-500 mt-1">Property code will be auto-generated</p>
                                @error('code')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Property Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Property Type *</label>
                                <select name="type" id="type" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Type</option>
                                    <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>House</option>
                                    <option value="townhouse" {{ old('type') == 'townhouse' ? 'selected' : '' }}>Townhouse</option>
                                    <option value="condo" {{ old('type') == 'condo' ? 'selected' : '' }}>Condominium</option>
                                    <option value="commercial" {{ old('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                                @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location *</label>
                                <input type="text" name="location" id="location" required value="{{ old('location') }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price (₱/month) *</label>
                                <input type="number" name="price" id="price" step="0.01" min="0" required
                                       value="{{ old('price') }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" id="status" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Status</option>
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                </select>
                                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Bedrooms -->
                            <div>
                                <label for="bedrooms" class="block text-sm font-medium text-gray-700">Bedrooms</label>
                                <input type="number" name="bedrooms" id="bedrooms" min="0" value="{{ old('bedrooms') }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('bedrooms')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Bathrooms -->
                            <div>
                                <label for="bathrooms" class="block text-sm font-medium text-gray-700">Bathrooms</label>
                                <input type="number" name="bathrooms" id="bathrooms" min="0" value="{{ old('bathrooms') }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('bathrooms')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Area -->
                            <div>
                                <label for="area_sqm" class="block text-sm font-medium text-gray-700">Area (sqm)</label>
                                <input type="number" name="area_sqm" id="area_sqm" min="0" step="0.01" value="{{ old('area_sqm') }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('area_sqm')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">Property Image</label>
                                <input type="file" name="image" id="image" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                <p class="text-xs text-gray-500 mt-1">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</p>
                                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                
                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-2 hidden">
                                    <img id="preview" class="h-32 w-auto rounded-lg border">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ old('description') }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.properties.index') }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                Save Property
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>