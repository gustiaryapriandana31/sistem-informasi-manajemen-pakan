@extends('layouts.main-dashboard.main')

@section('container')
     <section class="w-screen">
        <div class="min-h-screen flex-1 bg-white mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-12 md:pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2"><i class="pr-3 fa-solid fa-chart-line"></i>Feeding Methods</h1>
                </div>
            </div>

            <main class="flex flex-col gap-2 bg-blue-200 md:p-6 p-4 text-gray-800 font-poppins">
                <div class="bg-white shadow-md shadow-gray-400 px-8 py-6 rounded-lg">
                    <h1 class="text-lg font-bold">1. At Satiation</h1>
                    <p class="font-semibold text-sm md:text-base text-justify">Teknik pemberian pakan di mana ikan diberi pakan hingga merasa kenyang atau tidak mau makan lagi (sekenyang kenyangnya). Tujuan dari metode ini adalah untuk menentukan tingkat konsumsi pakan maksimum ikan dalam kondisi tertentu. Metode ini sering digunakan dalam budidaya untuk mengevaluasi efisiensi pakan, pertumbuhan, dan kesehatan ikan. Dalam praktiknya, pengamatan dilakukan untuk mengetahui waktu yang dibutuhkan ikan untuk mencapai kepuasan makan dan jumlah pakan yang dikonsumsi.
                    </p>
                    <div class="flex flex-col md:flex-row gap-6 text-sm mt-4">
                        <div class="shadow-lg shadow-blue-300 p-5 text-justify">
                            <h3 class="text-start mb-3 font-semibold text-lg text-green-400">Kelebihan</h3>
                            <article>1. Metode ini dapat disesuaikan dengan kebutuhan ikan sehingga pertumbuhan dapat mencapai potensi maksimal dan mengurangi risiko kekurangan pakan pada ikan.</article>
                            <article>2. Mengurangi stress karena ikan cenderung tenang dan tidak bersaing dengan ikan lain.</article>
                            <article>3. Petani dapat berinteraksi dengan ikan sehingga dapat memantau ikan yang sakit.</article>
                        </div>
                        <div class="shadow-lg shadow-blue-300 p-5 text-justify">
                            <h3 class="text-start mb-3 font-semibold text-lg text-red-400">Kekurangan</h3>
                            <article>1. Pemberian pakan membutuhkan waktu yang cukup lama sampai diamati ikan tidak mau lagi makan.</article>
                            <article>2. Variasi Konsumsi: Ikan yang dominan dalam kelompok mungkin makan lebih banyak dibandingkan yang lain, yang menyebabkan ketidakseimbangan konsumsi pakan di antara individu.</article>
                            <article>3. Sulit Mengukur Kebutuhan Pakan: Sulit untuk mengetahui berapa banyak pakan yang tepat harus diberikan karena setiap ikan mungkin memiliki kebutuhan makan yang berbeda.</article>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md shadow-gray-400 px-8 py-6 rounded-lg">
                    <h1 class="text-lg font-bold">2. Ad Libitum</h1>
                    <p class="font-semibold text-sm md:text-base text-justify">Teknik pemberian pakan di mana ikan diberi pakan hingga merasa kenyang atau tidak mau makan lagi (sekenyang kenyangnya). Tujuan dari metode ini adalah untuk menentukan tingkat konsumsi pakan maksimum ikan dalam kondisi tertentu. Metode ini sering digunakan dalam budidaya untuk mengevaluasi efisiensi pakan, pertumbuhan, dan kesehatan ikan. Dalam praktiknya, pengamatan dilakukan untuk mengetahui waktu yang dibutuhkan ikan untuk mencapai kepuasan makan dan jumlah pakan yang dikonsumsi.
                    </p>
                    <div class="flex flex-col md:flex-row gap-6 text-sm mt-4">
                        <div class="shadow-lg shadow-blue-300 p-5 text-justify">
                            <h3 class="text-start mb-3 font-semibold text-lg text-green-400">Kelebihan</h3>
                            <article>1. <span class="font-bold">Pertumbuhan Lebih Cepat : </span>Ikan dapat makan kapan saja, sehingga dapat meningkatkan asupan nutrisi yang optimal dan mempercepat pertumbuhan serta produktivitas.</article>
                            <article>2. <span class="font-bold">Efisiensi Waktu dan Tenaga : </span>Karena pakan selalu tersedia, peternak tidak perlu memberikan pakan secara terjadwal, yang menghemat waktu dan tenaga.</article>
                            <article>3. <span class="font-bold">Pengurangan Stres pada Ikan : </span>Ikan yang selalu memiliki akses ke pakan cenderung lebih tenang dan tidak mengalami stres akibat kekurangan makanan, yang bisa berdampak pada kesehatan dan kesejahteraan mereka.</article>
                        </div>
                        <div class="shadow-lg shadow-blue-300 p-5 text-justify">
                            <h3 class="text-start mb-3 font-semibold text-lg text-red-400">Kekurangan</h3>
                            <article>1. <span class="font-bold">Pemborosan Pakan : </span>Ikan yang makan sepuasnya cenderung membuang-buang pakan, baik melalui sisa yang tidak termakan atau ketidakefisienan dalam konsumsi.</article>
                            <article>2. <span class="font-bold">Peningkatan Biaya : </span>Konsumsi pakan yang lebih tinggi bisa meningkatkan biaya pakan secara signifikan, terutama jika harga pakan mahal atau jika ikan makan lebih dari yang diperlukan.</article>
                            <article>3. <span class="font-bold">Risiko Kegemukan :</span>Ikan yang diberi pakan bebas cenderung makan berlebihan, yang bisa menyebabkan obesitas dan masalah kesehatan lainnya, seperti penurunan kualitas daging atau kerentanan terhadap penyakit.</article>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md shadow-gray-400 px-8 py-6 rounded-lg">
                    <h1 class="text-lg font-bold italic">3. Feeding Rate</h1>
                    <p class="font-semibold text-sm md:text-base text-justify">Feeding rate pada ikan adalah metode pemberian jumlah pakan pada ikan dalam periode waktu tertentu. Ini biasanya dinyatakan dalam persentase dari berat badan ikan per hari. Feeding rate yang tepat penting untuk memastikan pertumbuhan optimal, kesehatan, dan efisiensi pakan.
                    </p>
                    <details class="mt-2 text-orange-400 text-sm md:text-base">
                        <summary>Adapun nilai FR dipengaruhi oleh : </summary>
                        <p class="text-justify">1. Ukuran dan usia ikan: Ikan muda mungkin memerlukan feeding rate yang lebih tinggi dibandingkan ikan dewasa.</p>
                        <p class="text-justify">2. Jenis ikan: Setiap spesies memiliki kebutuhan pakan yang berbeda.</p>
                    </details>
                    <div class="flex flex-col md:flex-row gap-6 text-sm mt-4">
                        <div class="shadow-lg shadow-blue-300 p-5 text-justify">
                            <h3 class="text-start mb-3 font-semibold text-lg text-green-400">Kelebihan</h3>
                            <article>1. <span class=font-bold>Kontrol Pemberian Pakan : </span>Metode ini memungkinkan kontrol yang lebih baik terhadap jumlah pakan yang diberikan, sehingga meminimalkan risiko overfeeding atau underfeeding.</article>
                            <article>2. <span class=font-bold>Efisiensi Pakan : </span> Dengan memberikan pakan dalam jumlah yang terukur, metode ini meningkatkan efisiensi penggunaan pakan dan mengurangi pemborosan.</article>
                            <article>3. <span class=font-bold>Mudah untuk Diimplementasikan : </span>3Feeding rate relatif mudah diterapkan di skala industri karena tidak memerlukan pengamatan yang konstan seperti pada metode at satiation.</article>
                        </div>
                        <div class="shadow-lg shadow-blue-300 p-5 text-justify">
                            <h3 class="text-start mb-3 font-semibold text-lg text-red-400">Kekurangan</h3>
                            <article>1. <span class=font-bold>Tidak Sepenuhnya Menyesuaikan Kebutuhan Ikan : </span>Feeding rate yang terlalu rendah atau tinggi bisa menyebabkan ikan kekurangan atau kelebihan pakan, yang mempengaruhi pertumbuhan dan kesehatannya.</article>
                            <article>2. <span class=font-bold>Penyesuaian yang Rumit : </span>Perhitungan feeding rate harus diperbarui secara berkala mengikuti perubahan berat tubuh ikan, yang bisa menjadi rumit dan memerlukan pemantauan intensif.</article>
                            <article>3. <span class=font-bold>Kebutuhan Pakan Berubah-ubah : </span> Kebutuhan ikan terhadap pakan bisa berbeda-beda setiap hari tergantung pada kondisi lingkungan, kesehatan, dan aktivitas, sehingga metode ini bisa kurang fleksibel.</article>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </section>
@endsection



























