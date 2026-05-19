<?php
// --- MOCK DATABASE (Data Tiruan untuk Keperluan Demo) ---
$input_budget = isset($_GET['budget']) ? (int)$_GET['budget'] : 0;

$all_menus = [
    ['name' => 'Nasi Ayam Geprek', 'price' => 12000, 'resto' => 'Kantin Hebat', 'image' => 'images/ayam-geprek.jpg', 'category' => 'makanan', 'tag' => 'Laris'],
    ['name' => 'Mie Ayam + Bakso', 'price' => 14000, 'resto' => 'Kantin Sehat', 'image' => 'images/mie-ayam-bakso.jpg', 'category' => 'makanan', 'tag' => 'Best Seller'],
    ['name' => 'Nasi Telur + Tempe', 'price' => 10000, 'resto' => 'Dapur Kampus', 'image' => 'images/nasi-telur-tempe.jpg', 'category' => 'makanan', 'tag' => 'Hemat'],
    ['name' => 'Es Teh Manis', 'price' => 3000, 'resto' => 'Kantin Hebat', 'image' => 'images/es-teh-manis.jpg', 'category' => 'minuman', 'tag' => 'Segar'],
    ['name' => 'Combo Worth It (Nasi + Ayam + Es Teh)', 'price' => 15000, 'resto' => 'Kantin Hebat', 'image' => 'images/nasi-ayam-esteh.jpg', 'category' => 'combo', 'tag' => 'Best Combo'],
    ['name' => 'Bakso Mercon', 'price' => 13000, 'resto' => 'Kantin Sehat', 'image' => 'images/bakso-mercon.jpg', 'category' => 'makanan', 'tag' => 'Pedas Mantap']
];

// Saring menu berdasarkan input budget
$filtered_menus = [];
if ($input_budget > 0) {
    foreach ($all_menus as $menu) {
        if ($menu['price'] <= $input_budget) {
            $filtered_menus[] = $menu;
        }
    }
} else {
    $filtered_menus = $all_menus;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetBite - Temukan Makanan Sesuai Budgetmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bb-green': '#22C55E',
                        'bb-orange': '#F97316',
                        'bb-yellow': '#FACC15',
                        'bb-gray': '#6B7280',
                        'bb-light': '#F9FAFB',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Sembunyikan scrollbar bawaan browser untuk menu kategori horizontal di Android */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-bb-light font-sans text-slate-800 min-h-screen pb-20 md:pb-0">

    <nav class="hidden md:flex bg-white border-b border-slate-200 sticky top-0 z-50 px-8 py-4 justify-between items-center shadow-sm">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-bb-green rounded-full flex items-center justify-center text-white font-bold text-sm">Rp</div>
            <span class="text-xl font-bold text-bb-green">Budget<span class="text-bb-orange">Bite</span></span>
        </div>
        <div class="flex space-x-6 text-sm font-semibold text-slate-600">
            <a href="#" class="text-bb-green">Home</a>
            <a href="#" class="hover:text-bb-green transition">Makanan</a>
            <a href="#" class="hover:text-bb-green transition">Terdekat</a>
            <a href="#" class="hover:text-bb-green transition">Favorit</a>
        </div>
    </nav>

    <div class="absolute top-0 right-0 left-0 h-48 bg-gradient-to-b from-green-50/50 to-transparent -z-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 py-6 md:py-10 grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8">
        
        <aside class="md:col-span-1 bg-white border border-slate-200/80 p-5 md:p-6 rounded-2xl shadow-sm md:h-fit sticky md:top-24 z-40">
            
            <div class="flex items-center space-x-3 mb-5 md:hidden">
                <div class="w-10 h-10 bg-bb-green rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md shadow-emerald-100">Rp</div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-bb-green">Budget<span class="text-bb-orange">Bite</span></h1>
                    <p class="text-[11px] text-bb-gray font-medium">Temukan Makanan Sesuai Budgetmu</p>
                </div>
            </div>

            <div class="hidden md:block mb-6">
                <h2 class="text-xl font-bold text-slate-800 leading-tight">Temukan Makanan <br><span class="text-bb-green">Sesuai Budgetmu</span></h2>
                <p class="text-xs text-bb-gray mt-1.5">Solusi hemat & cerdas mahasiswa akhir bulan di sekitar kampus.</p>
            </div>

            <form action="" method="GET" class="space-y-4">
                <div>
                    <label for="budget" class="block text-xs md:text-sm font-semibold text-slate-700 mb-2">Isi Budget Kamu :</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-400 font-bold text-sm md:text-base">Rp</span>
                        </div>
                        <input type="number" name="budget" id="budget" 
                               class="block w-full pl-11 pr-4 py-2.5 md:py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:border-bb-green font-bold text-base md:text-lg text-slate-700 placeholder-slate-400 bg-slate-50/50 focus:bg-white transition" 
                               placeholder="15.000" 
                               value="<?php echo $input_budget > 0 ? $input_budget : ''; ?>" required>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-bb-green hover:bg-emerald-600 text-white font-semibold py-2.5 md:py-3 px-4 rounded-xl shadow-md shadow-emerald-100 hover:shadow-none transition duration-200 text-sm md:text-base text-center block">
                    Cari Makanan
                </button>
            </form>

            <?php if ($input_budget > 0): ?>
                <div class="mt-4 pt-3 border-t border-slate-100 flex justify-between items-center text-xs">
                    <span class="text-slate-600">Maks: <strong class="text-bb-orange">Rp <?php echo number_format($input_budget, 0, ',', '.'); ?></strong></span>
                    <a href="index.php" class="text-slate-400 font-semibold hover:text-bb-orange underline">Reset</a>
                </div>
            <?php endif; ?>
        </aside>

        <main class="md:col-span-3 space-y-5">
            
            <div class="flex space-x-2 overflow-x-auto pb-1 scrollbar-hide border-b border-slate-200 text-xs md:text-sm">
                <span class="bg-bb-green text-white px-4 py-2 rounded-full font-medium cursor-pointer shadow-sm flex-shrink-0">Semua</span>
                <span class="bg-white text-slate-600 border border-slate-200 px-4 py-2 rounded-full font-medium cursor-pointer hover:bg-slate-50 transition flex-shrink-0">Makanan</span>
                <span class="bg-white text-slate-600 border border-slate-200 px-4 py-2 rounded-full font-medium cursor-pointer hover:bg-slate-50 transition flex-shrink-0">Minuman</span>
                <span class="bg-white text-slate-600 border border-slate-200 px-4 py-2 rounded-full font-medium cursor-pointer hover:bg-slate-50 transition flex-shrink-0">Combo Paket</span>
            </div>

            <div class="flex justify-between items-center px-1">
                <h3 class="text-sm md:text-base font-bold text-slate-800 tracking-tight">Rekomendasi Untukmu</h3>
                <span class="text-[11px] md:text-xs bg-slate-200/70 text-slate-700 px-2.5 py-1 rounded-md font-semibold">
                    <?php echo count($filtered_menus); ?> Menu Pas
                </span>
            </div>

            <?php if (empty($filtered_menus)): ?>
                <div class="text-center py-12 bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                    <span class="text-3xl">😢</span>
                    <p class="text-xs md:text-sm font-medium text-slate-500 mt-2">Waduh, nggak ada yang pas nih. Coba naikkan sedikit budgetnya!</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($filtered_menus as $menu): ?>
                        
                        <div class="bg-white border border-slate-200/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 md:hover:-translate-y-1 transition duration-200 flex flex-row sm:flex-col justify-between h-28 sm:h-auto">
                            
                            <div class="relative w-28 sm:w-full h-full sm:h-40 flex-shrink-0">
                                <img src="<?php echo $menu['image']; ?>" alt="Menu" class="w-full h-full object-cover">
                                <span class="absolute top-2 left-2 bg-white/95 backdrop-blur-sm text-bb-orange text-[9px] md:text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm">
                                    <?php echo $menu['tag']; ?>
                                </span>
                            </div>

                            <div class="p-3 md:p-4 flex-1 flex flex-col justify-between min-w-0">
                                <div>
                                    <h4 class="font-bold text-xs md:text-sm text-slate-800 truncate mb-0.5"><?php echo $menu['name']; ?></h4>
                                    <p class="text-[11px] text-bb-gray flex items-center gap-1">
                                        <span>📍</span> <span class="truncate"><?php echo $menu['resto']; ?></span>
                                    </p>
                                </div>
                                
                                <div class="mt-2 sm:mt-4 pt-2 sm:pt-3 border-t border-slate-100 flex justify-between items-center">
                                    <span class="hidden sm:inline text-[11px] text-slate-400 font-medium">Harga</span>
                                    <p class="text-sm md:text-base font-bold text-bb-orange">
                                        Rp <?php echo number_format($menu['price'], 0, ',', '.'); ?>
                                    </p>
                                </div>
                            </div>

                        </div>
                        
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <footer class="md:hidden fixed bottom-0 left-0 right-0 border-t border-slate-200 bg-white/95 backdrop-blur-md p-2.5 grid grid-cols-4 text-center text-[10px] font-medium text-bb-gray z-50 shadow-lg">
        <div class="text-bb-green cursor-pointer">
            <span class="block text-xl mb-0.5">🏠</span> Home
        </div>
        <div class="hover:text-bb-green cursor-pointer transition">
            <span class="block text-xl mb-0.5">🍔</span> Makanan
        </div>
        <div class="hover:text-bb-green cursor-pointer transition">
            <span class="block text-xl mb-0.5">📍</span> Terdekat
        </div>
        <div class="hover:text-bb-green cursor-pointer transition">
            <span class="block text-xl mb-0.5">⭐</span> Favorit
        </div>
    </footer>

</body>
</html>