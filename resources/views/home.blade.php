@extends('layouts.app')

@section('title', 'Sumedang Creative Center | Ruang Kreatif Premium')

@section('content')

    <!-- HERO SECTION: Dark atmospheric + monumental uppercase headline -->
    <section class="relative bg-charcoal overflow-hidden min-h-[90vh] flex flex-col justify-center">
        <!-- Subtle grid/line pattern for texture (allowed as flat lines) -->
        <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,1) 1px, transparent 1px); background-size: 100px 100px;"></div>
        
        <div class="max-w-[1440px] mx-auto px-8 py-24 lg:py-32 relative z-10 w-full">
            <!-- Top Eyebrow like the reference "WORLDSTUDIO" -->
            <div class="flex items-center justify-center mb-16">
                <div class="h-px bg-white/20 w-16 md:w-32"></div>
                <span class="px-4 text-white/50 text-xs font-bold uppercase tracking-[0.2em]">The Creative Hub</span>
                <div class="h-px bg-white/20 w-16 md:w-32"></div>
            </div>

            <!-- Monumental Typography Layout (Inspired by reference) -->
            <div class="text-center max-w-5xl mx-auto relative">
                <!-- Scattered Floating Badges (Like the reference "Stuck at 10 Subscribers") -->
                <div class="hidden md:flex absolute top-0 left-0 bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-[32px] items-center">
                    <div class="w-2 h-2 bg-brand-red rounded-full mr-2"></div>
                    <span class="text-white text-[11px] font-extrabold uppercase">100% Free Access</span>
                </div>
                <div class="hidden md:flex absolute bottom-20 right-0 bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-[32px] items-center">
                    <i class="fas fa-bolt text-brand-red mr-2"></i>
                    <span class="text-white text-[11px] font-extrabold uppercase">High-Speed Internet</span>
                </div>

                <h1 class="text-5xl md:text-7xl lg:text-[110px] font-extrabold text-white uppercase leading-[0.85] tracking-[-0.02em] mb-8">
                    SUMEDANG<br>
                    <span class="text-brand-red">CREATIVE</span><br>
                    CENTER.
                </h1>
                
                <p class="text-lg md:text-2xl text-body-grey font-light max-w-2xl mx-auto mb-12">
                    Grow faster and smarter with top creator facilities, <span class="font-semibold text-white">stress-free.</span>
                </p>

                <!-- CTA -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#rooms" class="bg-brand-red text-white px-8 py-4 rounded-[60px] text-[14.4px] font-bold tracking-[0.144px] hover:opacity-90 transition-opacity">
                        EXPLORE FACILITIES
                    </a>
                    <a href="#booking" class="bg-white/10 text-white px-8 py-4 rounded-[24px] text-[14.4px] font-bold tracking-[0.144px] hover:bg-white/20 transition-colors backdrop-blur-sm">
                        <i class="fas fa-play-circle mr-2"></i> Watch Video
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- RED DIVIDER BAND -->
    <div class="w-full h-16 lg:h-20 bg-brand-red"></div>

    <!-- FEATURES SECTION (Editorial Canvas) -->
    <!-- Modeled after "LET US DO IT FOR YOU. SAY GOODBYE TO..." -->
    <section class="py-24 lg:py-32 bg-white relative">
        <!-- Vertical guide line -->
        <div class="hidden lg:block absolute top-0 bottom-0 left-1/2 w-px bg-gray-100 -translate-x-1/2"></div>
        
        <div class="max-w-[1200px] mx-auto px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-24">
                <h2 class="text-4xl md:text-5xl lg:text-[70px] font-extrabold text-charcoal uppercase leading-[0.9] tracking-tight mb-8">
                    SAY GOODBYE TO <br><span class="text-brand-red">CREATIVE STRUGGLES.</span>
                </h2>
                <p class="text-body-grey text-lg font-light">
                    Build your projects with a facility that knows what works.
                </p>
                <div class="mt-8">
                    <span class="bg-light-neutral text-charcoal px-5 py-2 rounded-[32px] text-sm font-bold shadow-none">
                        Our Services
                    </span>
                </div>
            </div>

            <!-- Minimalist Cards like reference -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 border border-gray-200 rounded-[6px] text-center hover:border-brand-red transition-colors group">
                    <div class="w-16 h-16 bg-light-neutral rounded-full flex items-center justify-center mx-auto mb-8 group-hover:bg-brand-red/10 transition-colors">
                        <div class="w-3 h-3 bg-brand-red rounded-full"></div>
                    </div>
                    <h3 class="text-lg font-bold text-charcoal mb-4 uppercase">Studio Production</h3>
                    <p class="text-body-grey text-sm leading-relaxed">
                        Studio lengkap dengan peralatan profesional terbaik untuk kebutuhan visual dan audio Anda.
                    </p>
                </div>

                <div class="bg-white p-10 border border-gray-200 rounded-[6px] text-center hover:border-brand-red transition-colors group">
                    <div class="w-16 h-16 bg-light-neutral rounded-full flex items-center justify-center mx-auto mb-8 group-hover:bg-brand-red/10 transition-colors">
                        <i class="fas fa-bolt text-brand-red"></i>
                    </div>
                    <h3 class="text-lg font-bold text-charcoal mb-4 uppercase">High-Speed Internet</h3>
                    <p class="text-body-grey text-sm leading-relaxed">
                        Koneksi fiber optic 1Gbps untuk produktivitas maksimal tanpa hambatan.
                    </p>
                </div>

                <div class="bg-white p-10 border border-gray-200 rounded-[6px] text-center hover:border-brand-red transition-colors group">
                    <div class="w-16 h-16 bg-light-neutral rounded-full flex items-center justify-center mx-auto mb-8 group-hover:bg-brand-red/10 transition-colors">
                        <i class="fas fa-users text-brand-red"></i>
                    </div>
                    <h3 class="text-lg font-bold text-charcoal mb-4 uppercase">Smart Meeting</h3>
                    <p class="text-body-grey text-sm leading-relaxed">
                        Sistem meeting cerdas dengan teknologi IoT untuk presentasi dan kolaborasi.
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#rooms" class="inline-block bg-brand-red text-white px-6 py-3 rounded-[60px] text-[12px] font-bold tracking-wide uppercase">Get Started Now</a>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS / PROCESS (Editorial Canvas) -->
    <!-- Modeled after "SIMPLE. HERE'S OUR EXACT PROCESS..." -->
    <section class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-[1200px] mx-auto px-8">
            <div class="flex items-center mb-16">
                <div class="text-[11px] font-bold text-body-grey tracking-[0.1em] uppercase w-32 shrink-0">How it works</div>
                <div class="h-px bg-gray-200 w-full"></div>
            </div>

            <div class="text-center mb-20 max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl lg:text-[60px] font-extrabold text-charcoal uppercase leading-[0.95] tracking-tight mb-6">
                    SIMPLE. HERE'S OUR EXACT PROCESS TO <span class="text-brand-red">BOOK A ROOM.</span>
                </h2>
                <p class="text-body-grey text-sm font-light uppercase tracking-widest">
                    Simple. This is exactly how we facilitate you.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach([
                    ['title' => 'Pilih Ruangan', 'desc' => 'Pilih ruangan yang sesuai kebutuhan.'],
                    ['title' => 'Pilih Waktu', 'desc' => 'Tentukan tanggal dan jam yang tersedia.'],
                    ['title' => 'Isi Formulir', 'desc' => 'Lengkapi data pemesanan.'],
                    ['title' => 'Konfirmasi', 'desc' => 'Tunggu konfirmasi admin.']
                ] as $index => $step)
                <div class="text-center relative">
                    <!-- Connector Line -->
                    @if(!$loop->last)
                    <div class="hidden md:block absolute top-16 left-[60%] w-full h-px bg-gray-200 z-0"></div>
                    @endif

                    <!-- Perfect Circle Number -->
                    <div class="w-32 h-32 rounded-full border border-gray-200 bg-white flex items-center justify-center mx-auto mb-8 relative z-10 {{ $index == 1 ? 'bg-brand-red text-white border-brand-red shadow-[0_0_0_8px_rgba(230,0,0,0.1)]' : 'text-gray-300' }} transition-colors">
                        <span class="text-[60px] font-light leading-none" style="margin-top: -5px;">{{ $index + 1 }}</span>
                    </div>
                    
                    <h3 class="text-[16px] font-bold text-charcoal mb-2 uppercase">{{ $step['title'] }}</h3>
                    <p class="text-body-grey text-xs leading-relaxed max-w-[200px] mx-auto">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ROOMS SECTION (White Editorial) -->
    <section id="rooms" class="py-24 bg-light-neutral">
        <div class="max-w-[1440px] mx-auto px-8">
            <div class="flex items-center mb-16">
                <div class="text-[11px] font-bold text-body-grey tracking-[0.1em] uppercase w-48 shrink-0">The Facilities</div>
                <div class="h-px bg-gray-300 w-full"></div>
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-[70px] font-extrabold text-charcoal uppercase leading-[0.9] tracking-tight mb-16">
                PREMIUM <span class="text-brand-red">SPACES.</span>
            </h2>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($rooms as $room)
                <div class="bg-white rounded-[6px] overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                    <!-- Image -->
                    <div class="aspect-video relative overflow-hidden bg-gray-100">
                        @php
                            $imageExists = false;
                            $imageUrl = null;
                            if ($room->image) {
                                if (Storage::disk('public')->exists($room->image)) {
                                    $imageExists = true;
                                    $imageUrl = Storage::url($room->image);
                                } elseif (file_exists(public_path('images/rooms/' . $room->image))) {
                                    $imageExists = true;
                                    $imageUrl = asset('images/rooms/' . $room->image);
                                }
                            }
                        @endphp
                        @if($imageExists)
                            <img src="{{ $imageUrl }}" alt="{{ $room->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-charcoal flex items-center justify-center">
                                <span class="text-white/20 font-bold uppercase text-2xl opacity-20">NO IMAGE</span>
                            </div>
                        @endif

                        <!-- Outlined Red Pill -->
                        <div class="absolute top-3 left-3 bg-white/90 border border-brand-red rounded-[2px] px-2 py-1 backdrop-blur-sm">
                            <span class="text-charcoal text-[10px] font-bold uppercase tracking-wider">
                                {{ $room->capacity }} PPL
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-charcoal mb-2 uppercase truncate">{{ $room->name }}</h3>
                        <p class="text-body-grey text-xs mb-6 line-clamp-2">{{ $room->description }}</p>
                        
                        <div class="flex gap-2 mt-auto">
                            <a href="{{ route('room.detail', $room->slug) }}" class="flex-1 bg-white text-form-grey border border-form-grey text-center py-2.5 rounded-[2px] text-[12px] font-bold uppercase hover:bg-light-neutral transition-colors">
                                Detail
                            </a>
                            <a href="{{ route('booking.create', $room->slug) }}" class="flex-1 bg-brand-red text-white text-center py-2.5 rounded-[2px] text-[12px] font-bold uppercase hover:opacity-90 transition-opacity">
                                Book
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- BOOKING CHECK SECTION (Institutional Charcoal Panel) -->
    <section id="booking" class="py-24 lg:py-32 bg-charcoal">
        <div class="max-w-[1200px] mx-auto px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl lg:text-[70px] font-extrabold text-white uppercase leading-[0.9] tracking-tight mb-6">
                    READY TO <span class="text-brand-red">START?</span>
                </h2>
                <p class="text-white/50 text-lg font-light">Check availability in real-time.</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <form id="availabilityForm" class="bg-white/5 p-8 rounded-[6px] border border-white/10">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-white/50 text-[11px] font-bold uppercase tracking-wider mb-3">Select Room</label>
                            <div class="relative">
                                <select id="roomSelect" class="w-full bg-transparent border-b-2 border-white/20 text-white py-2 focus:outline-none focus:border-brand-red transition-colors appearance-none rounded-none text-lg">
                                    <option value="" class="text-charcoal">All Rooms</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" class="text-charcoal">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-2 top-3 text-white/50 pointer-events-none"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-white/50 text-[11px] font-bold uppercase tracking-wider mb-3">Select Date</label>
                            <input type="date" id="dateSelect" value="{{ $today }}" min="{{ $today }}" 
                                   class="w-full bg-transparent border-b-2 border-white/20 text-white py-2 focus:outline-none focus:border-brand-red transition-colors appearance-none rounded-none text-lg [color-scheme:dark]">
                        </div>
                        <div class="flex items-end">
                            <button type="button" onclick="checkAvailability()" 
                                    class="w-full bg-brand-red text-white py-3 rounded-[2px] text-sm font-bold uppercase tracking-wider hover:bg-brand-red-dark transition-colors">
                                Check
                            </button>
                        </div>
                    </div>
                </form>
                
                <div id="availabilityResult" class="mt-8 hidden text-white"></div>
            </div>
        </div>
    </section>

    <!-- Global Impact Map Panel (Sustainability pages concept, used here for visual flair) -->
    <section class="py-24 bg-charcoal border-t border-white/10 relative overflow-hidden">
        <div class="max-w-[1440px] mx-auto px-8 relative z-10 flex flex-col md:flex-row items-center justify-between">
            <div class="w-full md:w-2/3 pr-8">
                <!-- A minimalist representation of a map / impact area -->
                <div class="relative w-full h-[400px] border border-white/10 rounded-[6px] bg-[#2a2d30] overflow-hidden">
                    <!-- Subtle grid background -->
                    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,1) 1px, transparent 1px); background-size: 50px 50px;"></div>
                    
                    <!-- Red circular markers -->
                    <div class="absolute top-[30%] left-[20%] w-3 h-3 bg-brand-red rounded-full shadow-[0_0_0_4px_rgba(230,0,0,0.2)]"></div>
                    <div class="absolute top-[60%] left-[45%] w-4 h-4 bg-brand-red rounded-full shadow-[0_0_0_6px_rgba(230,0,0,0.2)]"></div>
                    <div class="absolute top-[40%] left-[70%] w-2 h-2 bg-brand-red rounded-full shadow-[0_0_0_3px_rgba(230,0,0,0.2)]"></div>
                    <div class="absolute top-[75%] left-[80%] w-3 h-3 bg-brand-red rounded-full shadow-[0_0_0_4px_rgba(230,0,0,0.2)]"></div>

                    <!-- Label -->
                    <div class="absolute bottom-6 left-6 flex items-center">
                        <div class="w-2 h-2 bg-brand-red rounded-full mr-2"></div>
                        <span class="text-white text-[11px] font-bold uppercase tracking-wider">Operational Nodes</span>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 mt-12 md:mt-0 flex justify-end relative h-full">
                <!-- Rotated Wordmark (From DESIGN.md) -->
                <h2 class="text-[80px] md:text-[120px] font-extrabold text-brand-red uppercase leading-none tracking-tighter" style="writing-mode: vertical-rl; transform: rotate(180deg);">
                    IMPACT
                </h2>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
function checkAvailability() {
    const roomId = document.getElementById('roomSelect').value;
    const date = document.getElementById('dateSelect').value;
    const resultDiv = document.getElementById('availabilityResult');
    
    if (!date) { alert('Silakan pilih tanggal terlebih dahulu'); return; }
    
    resultDiv.classList.remove('hidden');
    resultDiv.innerHTML = '<div class="text-center py-8"><i class="fas fa-spinner fa-spin text-brand-red text-2xl"></i><p class="mt-2 text-white/50">Memeriksa ketersediaan...</p></div>';
    
    fetch('{{ route("check.availability") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ room_id: roomId, date: date })
    })
    .then(response => response.json())
    .then(data => {
        let html = '';
        if (roomId) {
            html = `<div class="bg-white/10 rounded-[6px] border border-white/20 p-6">
                <h3 class="text-xl font-bold text-white mb-4">Ketersediaan: ${data.room.name}</h3>
                <p class="text-white/50 mb-6">Tanggal: ${date}</p>`;
            
            if (data.booked_slots.length === 0) {
                html += `<div class="border-l-4 border-green-500 bg-green-500/10 p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                        <div><p class="font-bold text-green-400">Ruangan tersedia sepanjang hari!</p>
                        <p class="text-green-500/70 text-sm">Anda dapat booking ruangan ini kapan saja.</p></div>
                    </div></div>`;
            } else {
                html += `<div class="border-l-4 border-yellow-500 bg-yellow-500/10 p-4 mb-6">
                    <div class="flex items-center"><i class="fas fa-clock text-yellow-500 mr-3"></i>
                    <p class="font-bold text-yellow-400">Ruangan sudah dibooking pada jam berikut:</p></div>
                </div><div class="space-y-3 mb-6">`;
                data.booked_slots.forEach(slot => {
                    html += `<div class="flex items-center justify-between bg-black/20 p-3 rounded-[2px] border border-white/5">
                        <div class="flex items-center"><i class="fas fa-calendar-times text-brand-red mr-3"></i>
                        <span class="font-medium text-white/80">${slot.start} - ${slot.end}</span></div>
                        <span class="bg-brand-red/20 text-brand-red px-3 py-1 rounded-[2px] text-[10px] font-bold uppercase tracking-widest border border-brand-red/30">Booked</span>
                    </div>`;
                });
                html += '</div>';
            }
            
            if (!data.room) {
                const rooms = @json($rooms);
                rooms.forEach(room => { if (room.id == roomId) data.room = room; });
            }
            html += `<div class="text-center"><a href="${data.room ? '/room/' + data.room.slug : '#'}" 
                class="inline-block bg-brand-red text-white px-8 py-3 rounded-[60px] text-[12px] font-bold uppercase tracking-wider hover:opacity-90">
                <i class="fas fa-calendar-plus mr-2"></i>Booking Ruangan Ini</a></div></div>`;
        } else {
            html = '<h3 class="text-lg font-bold text-white mb-4">Ketersediaan Semua Ruangan</h3>';
            @foreach($rooms as $room)
                html += `<div class="border border-white/20 bg-white/5 rounded-[6px] p-5 mb-4 hover:border-brand-red transition-colors">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="font-bold text-white">{{ $room->name }}</h4>
                        <span class="border border-brand-red text-brand-red px-2 py-0.5 rounded-[2px] text-[10px] font-bold uppercase tracking-wider">GRATIS</span>
                    </div>
                    <div class="flex items-center text-white/50 mb-2 text-sm"><i class="fas fa-users mr-2 text-brand-red"></i>Kapasitas: {{ $room->capacity }} orang</div>
                    <div class="flex items-center justify-between">
                        <span class="text-white/50 text-xs hidden md:block">{{ Str::limit($room->description, 50) }}</span>
                        <a href="/room/{{ $room->slug }}" class="bg-brand-red text-white px-4 py-2 rounded-[2px] text-[11px] font-bold tracking-wider uppercase hover:opacity-90">Cek Jadwal</a>
                    </div></div>`;
            @endforeach
        }
        resultDiv.innerHTML = html;
    })
    .catch(error => {
        resultDiv.innerHTML = `<div class="border-l-4 border-brand-red bg-brand-red/10 p-4 rounded-[6px]">
            <div class="flex items-center"><i class="fas fa-exclamation-circle text-brand-red mr-3 text-xl"></i>
            <div><p class="font-bold text-white">Terjadi kesalahan</p>
            <p class="text-white/50 text-sm">Gagal memeriksa ketersediaan. Silakan coba lagi.</p></div></div></div>`;
    });
}
</script>

<style>
.line-clamp-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
</style>
@endsection