<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lease Details - PropertyManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Include jsPDF library for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <x-layouts.customer-nav />

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <nav class="flex items-center space-x-2 text-sm text-blue-200 mb-6">
                <a href="{{ route('customer.leases.index') }}" class="hover:text-white transition-colors">My Leases</a>
                <i class="fas fa-chevron-right text-blue-300"></i>
                <span class="text-white font-semibold">{{ $tenant->property_unit }}</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-3">Lease Agreement</h1>
                    <div class="flex items-center space-x-4">
                        <span
                            class="px-4 py-2 rounded-full text-sm font-semibold bg-white bg-opacity-20 backdrop-blur-sm
                            {{ $tenant->status == 'active'
                                ? 'text-green-300'
                                : ($tenant->status == 'pending'
                                    ? 'text-yellow-300'
                                    : 'text-red-300') }}">
                            <i
                                class="fas fa-{{ $tenant->status == 'active' ? 'check-circle' : ($tenant->status == 'pending' ? 'clock' : 'times-circle') }} mr-2"></i>
                            {{ ucfirst($tenant->status) }}
                        </span>

                    </div>
                </div>
                <div class="mt-4 lg:mt-0">
                    <div class="text-4xl font-bold text-white">₱{{ number_format($tenant->rent_amount) }}/month</div>
                    <p class="text-blue-200 text-right mt-1">Monthly Rental</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Download Lease Button -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h2 class="text-xl font-bold text-gray-900 mb-2">Download Professional Lease Agreement</h2>
                            <p class="text-gray-600">Get a complete PDF copy with all terms, conditions, and legal
                                provisions.</p>
                        </div>
                        <button id="downloadLeaseBtn"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center">
                            <i class="fas fa-file-download mr-2"></i>
                            Download Lease Agreement
                        </button>
                    </div>
                    <!-- Loading indicator -->
                    <div id="loadingIndicator" class="hidden mt-4 text-center">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Generating professional lease agreement...
                        </div>
                    </div>
                    <!-- Success message -->
                    <div id="successMessage" class="hidden mt-4 text-center">
                        <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-lg">
                            <i class="fas fa-check-circle mr-2"></i>
                            Lease agreement downloaded successfully!
                        </div>
                    </div>
                </div>

                <!-- Quick Overview Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg mr-4">
                                <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Lease Duration</p>
                                <p class="text-lg font-bold text-gray-900">
                                    {{ floor(\Carbon\Carbon::parse($tenant->lease_start)->floatDiffInMonths(\Carbon\Carbon::parse($tenant->lease_end))) }}
                                    months
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-clock text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Days Remaining</p>
                                <p class="text-lg font-bold text-gray-900">
                                    @php
                                        $endDate = \Carbon\Carbon::parse($tenant->lease_end)->startOfDay();
                                        $today = \Carbon\Carbon::now()->startOfDay();
                                        $isExpired = $today->gt($endDate);
                                        $daysRemaining = $today->diffInDays($endDate);
                                    @endphp
                                    @if ($isExpired)
                                        <span class="text-red-600">Expired</span>
                                    @else
                                        {{ $daysRemaining }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg mr-4">
                                <i class="fas fa-home text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Property Type</p>
                                <p class="text-lg font-bold text-gray-900">
                                    {{ ucfirst($tenant->property->type ?? 'N/A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lease Details -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-file-contract text-blue-600 mr-3"></i>
                        Lease Information
                    </h2>
                    <p class="text-gray-600 mb-6">Complete details of your rental agreement</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Tenant Information -->
                        <div class="space-y-6">
                            <div class="bg-blue-50 rounded-xl p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-user text-blue-600 mr-2"></i>
                                    Tenant Information
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                        <span class="text-gray-600 font-medium">Full Name:</span>
                                        <span class="font-semibold text-gray-900">{{ $tenant->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                        <span class="text-gray-600 font-medium">Email:</span>
                                        <span class="font-semibold text-gray-900">{{ $tenant->email }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600 font-medium">Phone:</span>
                                        <span
                                            class="font-semibold text-gray-900">{{ $tenant->phone ?? 'Not provided' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Property Information -->
                        <div class="space-y-6">
                            <div class="bg-green-50 rounded-xl p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-building text-green-600 mr-2"></i>
                                    Property Information
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-green-100">
                                        <span class="text-gray-600 font-medium">Property:</span>
                                        <span class="font-semibold text-gray-900">{{ $tenant->property_unit }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-green-100">
                                        <span class="text-gray-600 font-medium">Location:</span>
                                        <span
                                            class="font-semibold text-gray-900">{{ $tenant->property->location ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600 font-medium">Type:</span>
                                        <span
                                            class="font-semibold text-gray-900">{{ $tenant->property->type ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lease Period & Payment -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-calendar-check text-purple-600 mr-3"></i>
                        Lease Period & Payment
                    </h2>
                    <p class="text-gray-600 mb-6">Rental duration and payment details</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Lease Duration -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Lease Duration</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-play text-green-500 mr-3"></i>
                                        <span class="text-gray-700">Start Date</span>
                                    </div>
                                    <span
                                        class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($tenant->lease_start)->format('F d, Y') }}</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-flag-checkered text-red-500 mr-3"></i>
                                        <span class="text-gray-700">End Date</span>
                                    </div>
                                    <span
                                        class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($tenant->lease_end)->format('F d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Details</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave text-blue-500 mr-3"></i>
                                        <span class="text-gray-700">Monthly Rent</span>
                                    </div>
                                    <span
                                        class="text-xl font-bold text-blue-600">₱{{ number_format($tenant->rent_amount, 2) }}</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-day text-yellow-500 mr-3"></i>
                                        <span class="text-gray-700">Payment Due</span>
                                    </div>
                                    <span class="font-semibold text-gray-900">5th of each month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div
                    class="bg-white rounded-2xl shadow-lg p-6 border-2
                    {{ $tenant->status == 'active'
                        ? 'border-green-200'
                        : ($tenant->status == 'pending'
                            ? 'border-yellow-200'
                            : 'border-red-200') }}">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <i
                            class="fas fa-info-circle mr-2
                            {{ $tenant->status == 'active'
                                ? 'text-green-600'
                                : ($tenant->status == 'pending'
                                    ? 'text-yellow-600'
                                    : 'text-red-600') }}"></i>
                        Lease Status
                    </h3>

                    @if ($tenant->status == 'active')
                        <div
                            class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 text-2xl mr-3"></i>
                                <div>
                                    <span class="text-green-800 font-bold text-lg">Active Lease</span>
                                    <p class="text-green-600 text-sm mt-1">Your lease agreement is currently active and
                                        in good standing.</p>
                                </div>
                            </div>
                        </div>
                    @elseif($tenant->status == 'pending')
                        <div
                            class="bg-gradient-to-r from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-yellow-500 text-2xl mr-3"></i>
                                <div>
                                    <span class="text-yellow-800 font-bold text-lg">Pending Approval</span>
                                    <p class="text-yellow-600 text-sm mt-1">Your application is under review by our
                                        team.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <i class="fas fa-times-circle text-red-500 text-2xl mr-3"></i>
                                <div>
                                    <span class="text-red-800 font-bold text-lg">Inactive</span>
                                    <p class="text-red-600 text-sm mt-1">This lease agreement is no longer active.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Contact Info + Quick Actions (kept same as before) -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-headset mr-2"></i>
                        Need Help?
                    </h3>

                    <div class="space-y-4 mb-6">
                        <div class="flex items-center bg-white bg-opacity-20 rounded-lg p-3">
                            <i class="fas fa-phone-alt mr-3 text-blue-200"></i>
                            <span>+63 912 345 6789</span>
                        </div>
                        <div class="flex items-center bg-white bg-opacity-20 rounded-lg p-3">
                            <i class="fas fa-envelope mr-3 text-blue-200"></i>
                            <span>support@propertymanager.com</span>
                        </div>
                        <div class="flex items-center bg-white bg-opacity-20 rounded-lg p-3">
                            <i class="fas fa-clock mr-3 text-blue-200"></i>
                            <span>Mon-Fri, 8AM-6PM</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button id="sidebarDownloadBtn"
                            class="w-full flex items-center p-3 bg-gray-50 hover:bg-blue-50 rounded-lg transition-colors group">
                            <i class="fas fa-file-download text-gray-400 group-hover:text-blue-600 mr-3"></i>
                            <span class="text-gray-700 group-hover:text-blue-600 font-medium">Download Lease
                                Agreement</span>
                        </button>
                        <a href="{{ route('customer.repairs.create') }}"
                            class="flex items-center p-3 bg-gray-50 hover:bg-purple-50 rounded-lg transition-colors group">
                            <i class="fas fa-tools text-gray-400 group-hover:text-purple-600 mr-3"></i>
                            <span class="text-gray-700 group-hover:text-purple-600 font-medium">Request
                                Maintenance</span>
                        </a>
                    </div>
                </div>
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
            <p class="text-gray-400">&copy; 2025 PropertyManager. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript for Professional PDF Generation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const downloadBtn = document.getElementById('downloadLeaseBtn');
            const sidebarDownloadBtn = document.getElementById('sidebarDownloadBtn');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const successMessage = document.getElementById('successMessage');

            // Function to generate professional lease agreement PDF
            function generateProfessionalLeasePDF() {
                // Show loading indicator
                loadingIndicator.classList.remove('hidden');
                successMessage.classList.add('hidden');

                // Use jsPDF to create the PDF
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();
                let yPosition = 20;
                const lineHeight = 6;
                const margin = 20;
                const pageWidth = doc.internal.pageSize.width;
                const contentWidth = pageWidth - (2 * margin);

                // Function to add section header
                function addSection(title, y) {
                    doc.setFillColor(41, 128, 185);
                    doc.rect(margin, y, contentWidth, 8, 'F');
                    doc.setTextColor(255, 255, 255);
                    doc.setFontSize(11);
                    doc.setFont(undefined, 'bold');
                    doc.text(title, margin + 5, y + 5);
                    doc.setTextColor(0, 0, 0);
                    doc.setFont(undefined, 'normal');
                    return y + 12;
                }

                // Function to add text with line breaks
                function addText(text, y, isBold = false, fontSize = 10) {
                    doc.setFontSize(fontSize);
                    if (isBold) {
                        doc.setFont(undefined, 'bold');
                    }

                    const lines = doc.splitTextToSize(text, contentWidth);
                    doc.text(lines, margin, y);

                    if (isBold) {
                        doc.setFont(undefined, 'normal');
                    }
                    return y + (lines.length * lineHeight);
                }

                // Function to check page break
                function checkPageBreak(y) {
                    if (y > 270) {
                        doc.addPage();
                        return 20;
                    }
                    return y;
                }

                // HEADER -- sa
                doc.setFillColor(52, 152, 219);
                doc.rect(0, 0, pageWidth, 45, 'F');
                doc.setTextColor(255, 255, 255);
                doc.setFontSize(22);
                doc.setFont(undefined, 'bold');
                doc.text('RESIDENTIAL LEASE AGREEMENT', pageWidth / 2, 20, {
                    align: 'center'
                });
                doc.setFontSize(12);
                doc.text('PROPERTY MANAGEMENT SERVICES', pageWidth / 2, 30, {
                    align: 'center'
                });
                doc.setFontSize(10);
                doc.text('Professional Property Management Company', pageWidth / 2, 38, {
                    align: 'center'
                });
                doc.setTextColor(0, 0, 0);

                yPosition = 60;

                // PARTIES SECTION
                yPosition = addSection('1. PARTIES TO THIS AGREEMENT', yPosition);
                yPosition = checkPageBreak(yPosition);

                yPosition = addText('This Lease Agreement ("Agreement") is made and entered into on ' +
                    '{{ \Carbon\Carbon::now()->format('F d, Y') }}' +
                    ' between:', yPosition);
                yPosition += lineHeight;

                yPosition = addText('LANDLORD/PROPERTY MANAGER:', yPosition, true);
                yPosition = addText('Property Management Services', yPosition);
                yPosition = addText('Professional Property Management Company', yPosition);
                yPosition = addText('Email: support@propertymanager.com | Phone: +63 912 345 6789', yPosition);
                yPosition += lineHeight;

                yPosition = addText('TENANT:', yPosition, true);
                yPosition = addText('{{ $tenant->name }}', yPosition);
                yPosition = addText('Email: {{ $tenant->email }}', yPosition);
                yPosition = addText('Phone: {{ $tenant->phone ?? 'Not provided' }}', yPosition);
                yPosition += lineHeight;

                // PROPERTY INFORMATION
                yPosition = addSection('2. PROPERTY INFORMATION', yPosition);
                yPosition = checkPageBreak(yPosition);

                yPosition = addText(
                    'The Landlord agrees to lease to the Tenant the following residential property:', yPosition);
                yPosition += lineHeight;

                yPosition = addText('Property Unit: {{ $tenant->property_unit }}', yPosition, true);
                yPosition = addText('Location: {{ $tenant->property->location ?? 'N/A' }}', yPosition);
                yPosition = addText('Property Type: {{ $tenant->property->type ?? 'N/A' }}', yPosition);
                yPosition += lineHeight;

                // LEASE TERM
                yPosition = addSection('3. LEASE TERM', yPosition);
                yPosition = checkPageBreak(yPosition);

                yPosition = addText('The lease term shall be for a period of ' +
                    '{{ (int) \Carbon\Carbon::parse($tenant->lease_start)->diffInMonths(\Carbon\Carbon::parse($tenant->lease_end)) }} months' +
                    ' commencing on:', yPosition);
                yPosition += lineHeight;

                yPosition = addText(
                    'Commencement Date: {{ \Carbon\Carbon::parse($tenant->lease_start)->format('F d, Y') }}',
                    yPosition, true);
                yPosition = addText(
                    'Expiration Date: {{ \Carbon\Carbon::parse($tenant->lease_end)->format('F d, Y') }}',
                    yPosition, true);
                yPosition += lineHeight;

                // RENTAL PAYMENTS
                yPosition = addSection('4. RENTAL PAYMENTS AND CHARGES', yPosition);
                yPosition = checkPageBreak(yPosition);

                // Format rent amount using JavaScript (use ASCII 'PHP' currency to avoid jsPDF font/encoding issues)
                const rentAmount = {{ $tenant->rent_amount }};
                const formattedRent = rentAmount.toLocaleString('en-PH', {
                    style: 'currency',
                    currency: 'PHP',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                // Create section content as plain strings
                const rentalLines = [{
                        text: '4.1 Monthly Rent: ' + formattedRent,
                        bold: true
                    },
                    {
                        text: '4.2 Payment Due Date: 5th day of each calendar month',
                        bold: false
                    },
                    {
                        text: '4.3 Late Payment Fee: 5% of monthly rent if paid after due date',
                        bold: false
                    },
                    {
                        text: '4.4 Security Deposit: Equivalent to one (1) month\'s rent',
                        bold: false
                    },
                    {
                        text: '4.5 Payment Methods: Bank transfer, GCash, or Manager\'s Check',
                        bold: false
                    }
                ];

                // Add each line separately
                rentalLines.forEach(line => {
                    yPosition = addText(line.text, yPosition, line.bold);
                });
                yPosition += lineHeight;

                // TERMS AND CONDITIONS
                yPosition = addSection('5. TERMS AND CONDITIONS', yPosition);
                yPosition = checkPageBreak(yPosition);

                const terms = [
                    '5.1 USE OF PROPERTY: Tenant shall use the property exclusively as a private residential dwelling.',
                    '5.2 MAINTENANCE: Tenant shall maintain the property in clean, sanitary, and good condition.',
                    '5.3 ALTERATIONS: No alterations, additions, or improvements without Landlord\'s written consent.',
                    '5.4 UTILITIES: Tenant responsible for all utilities (water, electricity, internet, etc.).',
                    '5.5 QUIET ENJOYMENT: Tenant shall not disturb neighbors or engage in disruptive activities.',
                    '5.6 PROPERTY INSPECTION: Landlord may inspect with 24 hours prior written notice.',
                    '5.7 SUBLETTING: Subletting or assignment prohibited without written consent.',
                    '5.8 PETS: No pets allowed without prior written approval and pet deposit.',
                    '5.9 INSURANCE: Tenant responsible for personal property insurance.',
                    '5.10 DEFAULT: Failure to pay rent or violation of terms may result in termination.',
                    '5.11 RENEWAL: Lease may be renewed by mutual written agreement 30 days prior to expiration.',
                    '5.12 GOVERNING LAW: This Agreement shall be governed by Philippines laws.'
                ];

                terms.forEach(term => {
                    yPosition = checkPageBreak(yPosition);
                    yPosition = addText(term, yPosition);
                    yPosition += 2;
                });

                // SIGNATURES SECTION
                yPosition = addSection('6. SIGNATURES', yPosition + 10);
                yPosition = checkPageBreak(yPosition);

                yPosition = addText(
                    'IN WITNESS WHEREOF, the parties have executed this Agreement as of the date first above written.',
                    yPosition);
                yPosition += 15;

                // Landlord signature area
                yPosition = addText('_________________________', yPosition, false, 12);
                yPosition = addText('LANDLORD/PROPERTY MANAGER', yPosition, true);
                yPosition = addText('Property Management Services', yPosition);
                yPosition = addText('Date: ___________________', yPosition);
                yPosition += 15;

                yPosition = checkPageBreak(yPosition);

                // Tenant signature area
                yPosition = addText('_________________________', yPosition, false, 12);
                yPosition = addText('TENANT', yPosition, true);
                yPosition = addText('{{ $tenant->name }}', yPosition);
                yPosition = addText('Date: ___________________', yPosition);
                yPosition += 10;

                // WITNESS SECTION
                yPosition = checkPageBreak(yPosition + 10);
                yPosition = addText('WITNESS:', yPosition, true);
                yPosition = addText('_________________________', yPosition, false, 12);
                yPosition = addText('Name: ___________________', yPosition);
                yPosition = addText('Date: ___________________', yPosition);

                // FOOTER
                yPosition = checkPageBreak(yPosition + 15);
                doc.setFontSize(8);
                doc.setTextColor(100, 100, 100);
                const today = new Date();
                const dateString = today.toLocaleDateString();
                doc.text('Document generated on ' + dateString +
                    ' - Property Management Services - Confidential and Proprietary',
                    pageWidth / 2, 290, {
                        align: 'center'
                    });

                // Save the PDF
                setTimeout(function() {
                    const fileName = 'Lease_Agreement_{{ $tenant->property_unit }}_' + dateString.replace(
                        /\//g, '-') + '.pdf';
                    doc.save(fileName);

                    // Hide loading indicator and show success message
                    loadingIndicator.classList.add('hidden');
                    successMessage.classList.remove('hidden');

                    // Hide success message after 3 seconds
                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                    }, 3000);
                }, 1500);
            }

            // Add event listeners to both download buttons
            if (downloadBtn) {
                downloadBtn.addEventListener('click', generateProfessionalLeasePDF);
            }

            if (sidebarDownloadBtn) {
                sidebarDownloadBtn.addEventListener('click', generateProfessionalLeasePDF);
            }
        });
    </script>
</body>

</html>
