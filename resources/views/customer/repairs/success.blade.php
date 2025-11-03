<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted - PropertyManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <x-layouts.customer-nav />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-green-500 text-3xl"></i>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Request Submitted Successfully!</h1>
            
            <div class="bg-gray-50 rounded-xl p-6 mb-6 text-left">
                <h3 class="font-semibold text-gray-900 mb-3">Request Details:</h3>
                <div class="space-y-2">
                    <p><strong>Request ID:</strong> #{{ $repair->id }}</p>
                    <p><strong>Property:</strong> {{ $repair->tenant->property_unit ?? 'N/A' }}</p>
                    <p><strong>Issue:</strong> {{ $repair->title }}</p>
                    <p><strong>Priority:</strong> 
                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                            {{ $repair->priority == 'urgent' ? 'bg-red-100 text-red-800' : 
                               ($repair->priority == 'high' ? 'bg-orange-100 text-orange-800' : 
                               ($repair->priority == 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')) }}">
                            {{ ucfirst($repair->priority) }}
                        </span>
                    </p>
                    <p><strong>Submitted:</strong> {{ $repair->created_at->format('M d, Y g:i A') }}</p>
                </div>
            </div>

            <p class="text-gray-600 mb-6">
                Your maintenance request has been submitted successfully. Our team will review it and contact you shortly.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('customer.dashboard') }}" 
                   class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-colors">
                    <i class="fas fa-home mr-2"></i>Back to Dashboard
                </a>
                <a href="{{ route('customer.repairs.create') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Submit Another Request
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-facebook text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
            </div>
            <p class="text-gray-400">&copy; 2024 PropertyManager. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>