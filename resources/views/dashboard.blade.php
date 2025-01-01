<x-app-layout>
    @if (session('error'))
        <div id="toast-danger"
            class="absolute bottom-10 right-10 mb-4 flex w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow dark:bg-gray-800 dark:text-gray-400"
            role="alert">
            <div
                class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-500 dark:bg-red-800 dark:text-red-200">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
            <button type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    <div class="flex grid h-48 grid-cols-6 items-center overflow-x-hidden bg-sky-600 object-cover">
        <svg class="flex h-full -translate-x-32 justify-start" xmlns="http://www.w3.org/2000/svg" width="400"
            height="300" viewBox="0 0 124 100" fill="none">
            <path
                d="M19.375 36.7818V100.625C19.375 102.834 21.1659 104.625 23.375 104.625H87.2181C90.7818 104.625 92.5664 100.316 90.0466 97.7966L26.2034 33.9534C23.6836 31.4336 19.375 33.2182 19.375 36.7818Z"
                fill="#075985" />
            <circle cx="90" cy="30" r="18.1641" fill="#c026d3" />
            <circle cx="100" cy="70" r="10" fill="#082f49" />
        </svg>
        <form action="{{ route('recomendation') }}" method="GET" class="col-span-4 mx-auto flex items-end gap-8">
            <label for="job-search" class="sr-only">Search</label>
            <div class="relative flex w-full flex-wrap">
                <label class="mb-2 text-white" for="job-search">Kerja Apa?</label>
                <input type="text" name="job-search" id="job-search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Programmer" value="{{ request('job-search') }}" />
            </div>

            <label for="location-search" class="sr-only">Search</label>
            <div class="relative flex w-full flex-wrap">
                <label class="mb-2 text-white" for="location-search">Dimana?</label>
                <input type="text" name="location-search" id="location-search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Jakarta" value="{{ request('location-search') }}" />
            </div>

            <button type="submit"
                class="h-fit rounded-lg border border-fuchsia-700 bg-fuchsia-700 px-6 py-2.5 text-sm font-medium text-white hover:bg-fuchsia-800 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 dark:bg-fuchsia-600 dark:hover:bg-fuchsia-700 dark:focus:ring-fuchsia-800">
                Search
            </button>
        </form>

        <svg class="flex h-full rotate-180 justify-start" xmlns="http://www.w3.org/2000/svg" width="400"
            height="300" viewBox="0 0 124 100" fill="none">
            <path
                d="M19.375 36.7818V100.625C19.375 102.834 21.1659 104.625 23.375 104.625H87.2181C90.7818 104.625 92.5664 100.316 90.0466 97.7966L26.2034 33.9534C23.6836 31.4336 19.375 33.2182 19.375 36.7818Z"
                fill="#082f49" />
            <circle cx="90" cy="40" r="18.1641" fill="#0369a1" />
            <circle cx="150" cy="70" r="10" fill="#075985" />
        </svg>
    </div>
    <div class="py-12">
        <div class="mx-auto flex max-w-7xl flex-col sm:px-6 lg:px-8">
            <div id="title">
                <h1 class="text-xl font-semibold text-gray-800">Temukan Peluang Karier Impian Anda</h1>
                <p class="text-sm text-gray-500">Temukan pekerjaan yang sesuai dengan keterampilan dan minat Anda,
                    dapatkan rekomendasi karier terbaik, dan lamar pekerjaan dengan mudah.</p>
            </div>
            <div class="mx-auto mt-4 flex flex-wrap justify-center gap-4">
                @foreach ($jobs as $job)
                    <x-card :logo="$job->company->logo" :companyName="$job->company->name" :position="$job->position" :salary="$job->salary" :description="$job->company->name"
                        :location="$job->location" :jobId="$job->id" />
                @endforeach
            </div>

            <!-- Main modal -->
            <div id="static-modal"
                class="fixed left-0 right-0 top-0 z-50 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-50">
                <div class="max-h-6xl relative max-w-7xl rounded-lg bg-white shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600">
                        <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                            Job Position
                        </h3>
                        <button data-modal-hide type="button"
                            class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            ✕
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div>
                        <div class="bg-sky-600">
                            <img class="mx-auto h-36 p-8" id="modal-company-logo" alt="Company logo" />
                        </div>
                    </div>
                    <div class="space-y-2 p-4">
                        <p id="modal-qualifications" class="text-base text-gray-500 dark:text-gray-400"></p>
                        <p id="modal-salary" class="text-base font-semibold text-sky-600 dark:text-white"></p>
                        <p id="modal-location" class="text-base text-gray-500 dark:text-gray-400"></p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center space-x-4 border-t p-4 dark:border-gray-600">
                        <a id="apply-now-btn" href="#"
                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-white hover:bg-blue-800">Apply Now</a>
                        <button data-modal-hide type="button"
                            class="rounded-lg bg-gray-200 px-5 py-2.5 text-gray-900 hover:bg-gray-300">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    function openModal(element) {
    const jobId = element.getAttribute('data-id');
    const userRole = "{{ auth()->check() ? auth()->user()->role : '' }}";
    fetch(`/job-vacancies/${jobId}`)
        .then(response => response.json())
        .then(job => {
                // Isi data di modal
                document.getElementById('modal-title').innerText = job.position;
                document.getElementById('modal-qualifications').innerText = job.qualifications;
                document.getElementById('modal-salary').innerText = `Rp ${job.salary.toLocaleString('id-ID')}`;
                document.getElementById('modal-location').innerText = job.location;
                document.getElementById('modal-company-logo').src = `{{ asset('storage/') }}/${job.company.logo}`;
                document.getElementById('modal-company-logo').alt = `${job.company.name} logo`;

                // Perbarui tombol "Apply Now" hanya jika user memiliki role 'employee'
                const applyNowBtn = document.getElementById('apply-now-btn');
                if (userRole === 'user') {
                    applyNowBtn.href = `/jobs/${jobId}/apply`;
                    applyNowBtn.classList.remove('hidden'); // Pastikan tombol ditampilkan
                } else {
                    applyNowBtn.classList.add('hidden'); // Sembunyikan tombol jika bukan employee
                }

                // Tampilkan modal
                const modal = document.getElementById('static-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            })
            .catch(error => {
                console.error('Error fetching job details:', error);
            });
        }


        // Close modal function
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById('static-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });
    </script>
</x-app-layout>
