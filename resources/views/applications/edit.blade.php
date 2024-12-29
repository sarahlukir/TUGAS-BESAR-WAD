<x-app-layout>
    <div class="container mx-auto max-w-lg py-12">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Edit Lamaran</h2>

        <!-- Detail Pekerjaan -->
        <div class="mb-6 rounded-lg border bg-white p-4 shadow">
            <h3 class="text-lg font-semibold text-gray-800">{{ $job->position }}</h3>
            <p class="text-sm text-gray-600">Perusahaan: {{ $company->name }}</p>
            <p class="text-sm text-gray-600">Lokasi: {{ $job->location }}</p>
            <p class="mt-2 text-sm text-gray-600">{{ $job->description }}</p>
            <p class="mt-2 text-sm font-medium text-blue-600">Gaji: Rp {{ number_format($job->salary, 0, ',', '.') }}</p>
        </div>

        <form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="cv" class="block text-sm font-medium text-gray-700">Upload CV</label>
                <input type="file" name="cv" id="cv"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('cv')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="supporting_documents" class="block text-sm font-medium text-gray-700">Dokumen Pendukung
                    (Opsional)</label>
                <input type="file" name="supporting_documents" id="supporting_documents"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('supporting_documents')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full rounded-lg bg-blue-700 px-5 py-3 text-center text-sm font-medium text-white hover:bg-blue-800">
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-app-layout>
