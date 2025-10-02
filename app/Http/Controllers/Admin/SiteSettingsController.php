<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiteSettingsController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::singleton();
        return view('admin.settings.home', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
                'dimensions:min_width=1600,min_height=600',
            ],
        ], [
            'hero_image.dimensions' => 'Use imagem com pelo menos 1600x600 px. Recomendado: 1920x756 px.',
            'hero_image.max'        => 'Imagem muito grande (máx. 4MB).',
            'hero_image.image'      => 'Envie um arquivo de imagem válido.',
            'hero_image.mimes'      => 'Formatos permitidos: WEBP, JPG, JPEG ou PNG.',
        ]);

        $settings = SiteSetting::singleton();
        $settings->updated_by = Auth::id();

        // Salva a nova imagem primeiro; só apaga a antiga depois de confirmar o save
        if ($request->hasFile('hero_image')) {
            $oldPath = $settings->hero_image; // ex.: banners/antigo.webp

            // Salva a nova em storage/app/public/banners
            $newPath = $request->file('hero_image')->store('banners', 'public'); 

            // Atualiza o registro
            $settings->hero_image = $newPath;
            $settings->save();

            // Remove a antiga com segurança (se diferente)
            if ($oldPath && $oldPath !== $newPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        } else {
            // Apenas metadados
            $settings->save();
        }

        return back()->with('success', 'Banner da Home atualizado com sucesso!');
    }
}
