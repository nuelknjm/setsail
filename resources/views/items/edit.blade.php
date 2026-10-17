<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Equipment — SetSail BizAccel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] },
                    colors: {
                        setsail: { maroon: '#802433', maroonDark: '#641B27', navy: '#1D2746', navyLight: '#2A3863' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col font-sans">
    <div class="h-1.5 w-full bg-gradient-to-r from-setsail-maroon via-setsail-navy to-setsail-maroon"></div>

    <div class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="max-w-lg w-full bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Top Logo Bar -->
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-white">
                <img src="{{ asset('logo.png') }}" alt="SetSail BizAccel" class="h-9 w-auto object-contain"
                     onerror="this.style.display='none'; document.getElementById('fallback-edit-logo').classList.remove('hidden');">
                <div id="fallback-edit-logo" class="hidden font-serif font-extrabold text-lg">
                    <span class="text-setsail-maroon">SetSail</span> <span class="text-setsail-navy">BizAccel</span>
                </div>
                <a href="{{ route('items.index') }}" class="text-xs font-semibold text-slate-500 hover:text-setsail-navy flex items-center gap-1">
                    &larr; Back to Inventory
                </a>
            </div>

            <div class="bg-setsail-navy px-6 py-3.5 flex items-center justify-between">
                <h1 class="text-sm font-bold text-white">Update Equipment Record #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</h1>
                <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase">Update Mode</span>
            </div>

            <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Equipment Name</label>
                    <input type="text" name="name" value="{{ $item->name }}" required
                           class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-setsail-maroon outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Category</label>
                    <select name="category" required class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm bg-white focus:ring-2 focus:ring-setsail-maroon outline-none">
                        @foreach(['Laptop / PC', 'Network Device', 'Monitor / Display', 'Peripherals'] as $cat)
                            <option value="{{ $cat }}" {{ $item->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Condition / Status</label>
                    <select name="status" required class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm bg-white focus:ring-2 focus:ring-setsail-maroon outline-none">
                        @foreach(['Available', 'In Use', 'Under Maintenance'] as $st)
                            <option value="{{ $st }}" {{ $item->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Equipment Photo</label>
                    <div class="flex items-center gap-4">
                        @if($item->image)
                            <img id="edit-preview" src="{{ asset('storage/' . $item->image) }}" class="w-20 h-20 object-cover rounded-xl border border-slate-200 shadow-sm">
                        @else
                            <img id="edit-preview" class="hidden w-20 h-20 object-cover rounded-xl border border-slate-200 shadow-sm">
                        @endif
                        <input type="file" name="image" accept="image/*" onchange="previewEdit(this)"
                               class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-rose-50 file:text-setsail-maroon hover:file:bg-rose-100">
                    </div>
                </div>

                <div class="pt-2 flex gap-3">
                    <a href="{{ route('items.index') }}" class="w-1/3 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2.5 rounded-xl text-sm transition">
                        Cancel
                    </a>
                    <button type="submit" class="w-2/3 bg-setsail-maroon hover:bg-setsail-maroonDark text-white font-semibold py-2.5 rounded-xl text-sm shadow-sm transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewEdit(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('edit-preview');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>