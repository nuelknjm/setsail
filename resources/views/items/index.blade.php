<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SetSail BizAccel — IT Asset Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        setsail: {
                            maroon: '#802433',
                            maroonDark: '#641B27',
                            navy: '#1D2746',
                            navyLight: '#2A3863',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <!-- Top Brand Accent Bar -->
    <div class="h-1.5 w-full bg-gradient-to-r from-setsail-maroon via-setsail-navy to-setsail-maroon"></div>

    <!-- Navigation Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <!-- Brand Logo & Title -->
            <div class="flex items-center gap-4">
                <a href="{{ route('items.index') }}" class="flex items-center">
                    <img src="{{ asset('logo.png') }}" alt="SetSail BizAccel Logo" class="h-12 w-auto object-contain"
                         onerror="this.style.display='none'; document.getElementById('fallback-logo').classList.remove('hidden');">
                    <!-- Fallback Typographic Logo if image not found -->
                    <div id="fallback-logo" class="hidden">
                        <div class="text-2xl font-serif font-extrabold tracking-tight leading-none">
                            <span class="text-setsail-maroon">SetSail</span>
                            <span class="text-setsail-navy">BizAccel</span>
                        </div>
                        <p class="text-[10px] text-slate-400 tracking-wider uppercase mt-0.5">The President University Business Accelerator</p>
                    </div>
                </a>
                <div class="hidden md:block h-8 w-px bg-slate-200"></div>
                <div class="hidden md:block">
                    <span class="text-xs font-semibold uppercase tracking-wider text-setsail-maroon bg-rose-50 px-2.5 py-0.5 rounded-full border border-rose-200">
                        IT Support Division
                    </span>
                    <h1 class="text-sm font-bold text-setsail-navy mt-0.5">Asset & Equipment Inventory System</h1>
                </div>
            </div>

            <!-- Right Actions: Status & API Endpoint -->
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    MySQL Connected
                </div>
                <a href="/api/items" target="_blank" class="inline-flex items-center gap-2 bg-setsail-navy hover:bg-setsail-navyLight text-white text-xs font-semibold px-4 py-2.5 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    <span>JSON API Endpoint</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-grow">

        <!-- Notification Banner -->
        @if(session('success'))
            <div id="alert-box" class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                </div>
                <button onclick="document.getElementById('alert-box').remove()" class="text-emerald-600 hover:text-emerald-900 text-sm font-bold">&times;</button>
            </div>
        @endif

        <!-- KPI Summary Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Assets</p>
                    <p class="text-2xl font-bold text-setsail-navy mt-1">{{ $items->count() }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-slate-100 text-setsail-navy flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Available</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ $items->where('status', 'Available')->count() }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider">In Use</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ $items->where('status', 'In Use')->count() }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Maintenance</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ $items->where('status', 'Under Maintenance')->count() }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Create Asset Form -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-24">
                    <div class="bg-setsail-navy px-6 py-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-base font-bold text-white">Register New Equipment</h2>
                            <p class="text-xs text-slate-300">Add item to MySQL database</p>
                        </div>
                        <span class="bg-setsail-maroon text-white text-[11px] font-bold px-2.5 py-1 rounded">CREATE</span>
                    </div>

                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Equipment Name <span class="text-setsail-maroon">*</span></label>
                            <input type="text" name="name" required placeholder="e.g. MacBook Pro M2 / Cisco Router"
                                   class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-setsail-maroon focus:border-setsail-maroon outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Category <span class="text-setsail-maroon">*</span></label>
                            <select name="category" required class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm bg-white focus:ring-2 focus:ring-setsail-maroon focus:border-setsail-maroon outline-none transition">
                                <option value="Laptop / PC">💻 Laptop / PC</option>
                                <option value="Network Device">🌐 Network Device</option>
                                <option value="Monitor / Display">🖥️ Monitor / Display</option>
                                <option value="Peripherals">⌨️ Peripherals & Accessories</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Condition / Status <span class="text-setsail-maroon">*</span></label>
                            <select name="status" required class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm bg-white focus:ring-2 focus:ring-setsail-maroon focus:border-setsail-maroon outline-none transition">
                                <option value="Available">Available (Ready to Deploy)</option>
                                <option value="In Use">In Use (Assigned)</option>
                                <option value="Under Maintenance">Under Maintenance (Repair)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Equipment Photo</label>
                            <label for="image-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-300 hover:border-setsail-maroon rounded-xl cursor-pointer bg-slate-50 hover:bg-rose-50/30 transition overflow-hidden relative">
                                <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-2">
                                    <svg class="w-7 h-7 mb-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-xs font-semibold text-slate-600">Click to upload image</p>
                                    <p class="text-[11px] text-slate-400">PNG, JPG, WEBP up to 2MB</p>
                                </div>
                                <img id="image-preview" class="hidden w-full h-full object-cover" />
                                <input id="image-upload" type="file" name="image" accept="image/*" class="hidden" onchange="previewFile(this)">
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-setsail-maroon hover:bg-setsail-maroonDark text-white font-semibold py-3 rounded-xl text-sm shadow-sm hover:shadow transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Save Equipment to Inventory</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Inventory Table -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <!-- Table Toolbar: Search & Filter -->
                    <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-bold text-setsail-navy">Registered IT Assets</h2>
                            <p class="text-xs text-slate-500">Auto-incrementing records with real-time search & status filter</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2.5">
                            <div class="relative">
                                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search asset name..."
                                       class="w-full sm:w-48 pl-9 pr-3 py-2 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-setsail-navy outline-none">
                                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>

                            <select id="statusFilter" onchange="filterTable()" class="text-xs border border-slate-300 rounded-lg px-3 py-2 bg-white focus:ring-2 focus:ring-setsail-navy outline-none">
                                <option value="">All Statuses</option>
                                <option value="Available">Available</option>
                                <option value="In Use">In Use</option>
                                <option value="Under Maintenance">Under Maintenance</option>
                            </select>
                        </div>
                    </div>

                    <!-- Responsive Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="inventoryTable">
                            <thead>
                                <tr class="bg-slate-50/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-200">
                                    <th class="py-3.5 px-4">No</th>
                                    <th class="py-3.5 px-4">Photo</th>
                                    <th class="py-3.5 px-4">Equipment Details</th>
                                    <th class="py-3.5 px-4">Category</th>
                                    <th class="py-3.5 px-4">Status</th>
                                    <th class="py-3.5 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 text-sm">
                                @forelse($items as $item)
                                    <tr class="hover:bg-slate-50/90 transition item-row">
                                        <!-- Auto-Increment Number (1, 2, 3...) -->
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-slate-100 text-setsail-navy font-bold text-xs">
                                                {{ $loop->iteration }}
                                            </span>
                                        </td>

                                        <!-- Thumbnail Image with Lightbox Click -->
                                        <td class="py-4 px-4">
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                                     onclick="openLightbox('{{ asset('storage/' . $item->image) }}', '{{ addslashes($item->name) }}')"
                                                     class="w-12 h-12 object-cover rounded-xl border border-slate-200 shadow-sm cursor-pointer hover:scale-105 transition">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex flex-col items-center justify-center text-[10px] font-medium text-slate-400">
                                                    <span>No Img</span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Asset Name & Database ID -->
                                        <td class="py-4 px-4 item-name">
                                            <p class="font-bold text-slate-800">{{ $item->name }}</p>
                                            <p class="text-[11px] text-slate-400">DB ID: #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }} &bull; Added {{ $item->created_at->diffForHumans() }}</p>
                                        </td>

                                        <!-- Category -->
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700">
                                                {{ $item->category }}
                                            </span>
                                        </td>

                                        <!-- Status Badge -->
                                        <td class="py-4 px-4 item-status">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $item->status == 'Available' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                                {{ $item->status == 'In Use' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                                {{ $item->status == 'Under Maintenance' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                                                <span class="w-1.5 h-1.5 rounded-full
                                                    {{ $item->status == 'Available' ? 'bg-emerald-500' : '' }}
                                                    {{ $item->status == 'In Use' ? 'bg-blue-500' : '' }}
                                                    {{ $item->status == 'Under Maintenance' ? 'bg-amber-500' : '' }}"></span>
                                                {{ $item->status }}
                                            </span>
                                        </td>

                                        <!-- Edit & Delete Buttons -->
                                        <td class="py-4 px-4 text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <a href="{{ route('items.edit', $item->id) }}"
                                                   class="inline-flex items-center gap-1 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 px-3 py-1.5 rounded-lg text-xs font-semibold transition shadow-sm">
                                                    <svg class="w-3.5 h-3.5 text-setsail-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>

                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove {{ addslashes($item->name) }} from inventory?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 bg-rose-50 hover:bg-setsail-maroon text-setsail-maroon hover:text-white border border-rose-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-12 px-4">
                                            <div class="max-w-xs mx-auto">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                    </svg>
                                                </div>
                                                <p class="text-sm font-bold text-slate-700">No IT assets registered yet</p>
                                                <p class="text-xs text-slate-400 mt-1">Use the form on the left to add your first device with photo.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Image Lightbox Modal -->
    <div id="lightbox" onclick="closeLightbox()" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-3 rounded-2xl max-w-lg w-full shadow-2xl" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" class="w-full max-h-96 object-contain rounded-xl bg-slate-100">
            <div class="flex justify-between items-center mt-3 px-1">
                <p id="lightbox-caption" class="text-sm font-bold text-setsail-navy"></p>
                <button onclick="closeLightbox()" class="text-xs font-semibold bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg">Close</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-12 py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400">
            <p><strong class="text-setsail-maroon">SetSail</strong> <strong class="text-setsail-navy">BizAccel</strong> &mdash; The President University Business Accelerator</p>
            <p class="mt-1 sm:mt-0">&copy; 2026 IT Support Division &bull; Developed by <span class="font-semibold text-setsail-navy">Immanuel Elvando</span></p>
        </div>
    </footer>

    <!-- Interactive UX Scripts -->
    <script>
        function previewFile(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    const placeholder = document.getElementById('upload-placeholder');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.item-row');

            rows.forEach(row => {
                const nameText = row.querySelector('.item-name').innerText.toLowerCase();
                const statusText = row.querySelector('.item-status').innerText.trim().toLowerCase();
                const matchSearch = nameText.includes(search);
                const matchStatus = status === '' || statusText === status;
                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }

        function openLightbox(src, caption) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-caption').innerText = caption;
            const lb = document.getElementById('lightbox');
            lb.classList.remove('hidden');
            lb.classList.add('flex');
        }

        function closeLightbox() {
            const lb = document.getElementById('lightbox');
            lb.classList.add('hidden');
            lb.classList.remove('flex');
        }
    </script>
</body>
</html>