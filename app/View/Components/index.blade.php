<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-2xl font-bold">Kelola Pengajuan Perusahaan</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 bg-white">
@extends('layouts.company')

@section('content')
    <div class="container mx-auto ml-64 max-w-6xl p-4">
        <h1 class="mb-6 text-2xl font-semibold text-gray-800">Kelola Pengajuan Perusahaan</h1>
        <div class="overflow-x-auto rounded-lg bg-white shadow-md">
            <table class="min-w-full bg-white">
<thead>
                    <tr class="bg-gray-100">
                    <tr class="border-b">
<th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Nama</th>
<th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Alamat</th>
<th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Aksi</th>
</tr>
</thead>
<tbody>
@foreach ($companies as $company)
                        <tr class="border">
                        <tr class="border-b hover:bg-gray-100">
<td class="px-6 py-4 text-sm text-gray-700">{{ $company->name }}</td>
<td class="px-6 py-4 text-sm text-gray-700">{{ $company->address }}</td>
<td class="flex gap-2 px-6 py-4">
@@ -39,4 +41,4 @@ class="rounded bg-red-500 px-4 py-2 text-sm font-bold text-white hover:bg-red-70
</table>
</div>
</div>
</x-app-layout>
@endsection