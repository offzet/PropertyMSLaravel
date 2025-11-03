<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Property') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- ADD ERROR DISPLAY -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Property Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Property Name *</label>
                                <input type="text" name="name" id="name" required value="{{ old('name', $property->name) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Property Code - ADD HIDDEN INPUT -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">Property Code</label>
                                <input type="text" name="code" id="code" value="{{ old('code', $property->code) }}" 
                                       class="mt-1 block w-full border border-gray-300 bg-gray-100 rounded-md shadow-sm p-2 cursor-not-allowed"
                                       readonly>
                                <input type="hidden" name="code" value="{{ $property->code }}"> <!-- ADD THIS -->
                                @error('code')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Type *</label>
                                <select name="type" id="type" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Type</option>
                                    <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>House</option>
                                    <option value="townhouse" {{ old('type', $property->type) == 'townhouse' ? 'selected' : '' }}>Townhouse</option>
                                    <option value="condo" {{ old('type', $property->type) == 'condo' ? 'selected' : '' }}>Condominium</option>
                                    <option value="commercial" {{ old('type', $property->type) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                                @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location *</label>
                                <input type="text" name="location" id="location" required value="{{ old('location', $property->location) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price *</label>
                                <input type="number" name="price" id="price" required min="0" step="0.01"
                                       value="{{ old('price', $property->price) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" id="status" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Status</option>
                                    <option value="available" {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="rented" {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>Rented</option>
                                    <option value="maintenance" {{ old('status', $property->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                                </select>
                                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Bedrooms -->
                            <div>
                                <label for="bedrooms" class="block text-sm font-medium text-gray-700">Bedrooms</label>
                                <input type="number" name="bedrooms" id="bedrooms" min="0"
                                       value="{{ old('bedrooms', $property->bedrooms) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('bedrooms')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Bathrooms -->
                            <div>
                                <label for="bathrooms" class="block text-sm font-medium text-gray-700">Bathrooms</label>
                                <input type="number" name="bathrooms" id="bathrooms" min="0"
                                       value="{{ old('bathrooms', $property->bathrooms) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('bathrooms')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Area -->
                            <div>
                                <label for="area_sqm" class="block text-sm font-medium text-gray-700">Area (sqm)</label>
                                <input type="number" name="area_sqm" id="area_sqm" min="0" step="0.01"
                                       value="{{ old('area_sqm', $property->area_sqm) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('area_sqm')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ old('description', $property->description) }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.properties.index') }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Cancel</a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                Update Property
                            </button>
                        </div>
                    </form>

                    <!-- Delete Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="bg-red-50 p-4 rounded-md">
                            <h3 class="text-lg font-medium text-red-800 mb-2">Danger Zone</h3>
                            <p class="text-red-600 mb-4">Once you delete a property, there is no going back. Please be certain.</p>
                            <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                                    Delete Property
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>