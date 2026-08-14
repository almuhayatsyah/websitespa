<?php

namespace App\Filament\Pages;

use App\Models\Pengaturan as PengaturanModel;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class Pengaturan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?string $title = 'Pengaturan Website';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.pengaturan';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = PengaturanModel::getSetting();
        $this->form->fill($setting->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // ── Identitas Situs ────────────────────────────
                Forms\Components\Section::make('🏥 Identitas Situs')
                    ->description('Informasi dasar spa yang tampil di seluruh halaman')
                    ->schema([
                        Forms\Components\TextInput::make('nama_situs')
                            ->label('Nama Situs')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('slogan')
                            ->label('Slogan / Tagline')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi_situs')
                            ->label('Deskripsi Situs')
                            ->rows(3)
                            ->helperText('Tampil di footer dan meta description default.')
                            ->columnSpanFull(),

                        // ── Gambar info (read-only preview, upload via tombol di header)
                        Forms\Components\Placeholder::make('logo_info')
                            ->label('Logo')
                            ->content(function () {
                                $setting = PengaturanModel::getSetting();
                                if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<img src="' . asset('storage/' . $setting->logo) . '" alt="Logo" style="max-height:60px;border-radius:6px;border:1px solid #e5e7eb;padding:4px;">'
                                        . '<br><small class="text-gray-500">Klik tombol "Upload Logo" di atas untuk mengganti</small>'
                                    );
                                }
                                return new \Illuminate\Support\HtmlString('<span class="text-gray-400 text-sm italic">Belum ada logo — klik "Upload Gambar" di atas</span>');
                            }),

                        Forms\Components\Placeholder::make('favicon_info')
                            ->label('Favicon')
                            ->content(function () {
                                $setting = PengaturanModel::getSetting();
                                if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<img src="' . asset('storage/' . $setting->favicon) . '" alt="Favicon" style="max-height:40px;border-radius:4px;border:1px solid #e5e7eb;padding:4px;">'
                                        . '<br><small class="text-gray-500">Klik tombol "Upload Favicon" di atas untuk mengganti</small>'
                                    );
                                }
                                return new \Illuminate\Support\HtmlString('<span class="text-gray-400 text-sm italic">Belum ada favicon — klik "Upload Gambar" di atas</span>');
                            }),

                        Forms\Components\Placeholder::make('gambar_hero_info')
                            ->label('Background Hero (Beranda)')
                            ->content(function () {
                                $setting = PengaturanModel::getSetting();
                                if ($setting->gambar_hero && Storage::disk('public')->exists($setting->gambar_hero)) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<img src="' . asset('storage/' . $setting->gambar_hero) . '" alt="Hero Background" style="max-height:60px;border-radius:4px;border:1px solid #e5e7eb;padding:4px;object-fit:cover;">'
                                        . '<br><small class="text-gray-500">Klik tombol "Upload Background Hero" di atas untuk mengganti</small>'
                                    );
                                }
                                return new \Illuminate\Support\HtmlString('<span class="text-gray-400 text-sm italic">Belum ada background — klik "Upload Background Hero" di atas</span>');
                            }),
                    ])->columns(2),

                // ── Informasi Perusahaan ───────────────────────
                Forms\Components\Section::make('📋 Informasi Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('nama_perusahaan')
                            ->label('Nama Perusahaan / Spa')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(2),

                        Forms\Components\TextInput::make('kode_pos')
                            ->label('Kode Pos')
                            ->maxLength(10),

                        Forms\Components\TextInput::make('telepon')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\TextInput::make('whatsapp')
                            ->label('WhatsApp (format: 628xxxxxxxx)')
                            ->tel()
                            ->maxLength(20)
                            ->helperText('Digunakan untuk FAB WhatsApp di website.'),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),

                // ── Profil Singkat (Visi, Misi, Nilai) ─────────
                Forms\Components\Section::make('🎯 Profil & Nilai Spa (Tentang Kami)')
                    ->schema([
                        Forms\Components\Textarea::make('visi')
                            ->label('Visi')
                            ->rows(3)
                            ->columnSpanFull()
                            ->required(),

                        Forms\Components\Repeater::make('misi')
                            ->label('Misi')
                            ->schema([
                                Forms\Components\TextInput::make('teks')
                                    ->label('Misi')
                                    ->required(),
                            ])
                            ->addActionLabel('+ Tambah Misi')
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('nilai_nilai')
                            ->label('Nilai-Nilai (Mengapa Memilih Kami)')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul (Contoh: Aman & Terpercaya)')
                                    ->required(),
                                Forms\Components\Textarea::make('desc')
                                    ->label('Deskripsi')
                                    ->rows(2)
                                    ->required(),
                                Forms\Components\Select::make('color')
                                    ->label('Warna Aksen')
                                    ->options([
                                        'clinic' => 'Biru (Clinic)',
                                        'teal' => 'Teal (Hijau Kebiruan)',
                                        'blue' => 'Biru',
                                        'green' => 'Hijau',
                                    ])
                                    ->default('clinic')
                                    ->required(),
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon SVG Path (Kosongkan untuk default)')
                                    ->helperText('Contoh: <path d="..."></path>'),
                            ])
                            ->columns(2)
                            ->addActionLabel('+ Tambah Nilai')
                            ->columnSpanFull(),
                    ]),

                // ── Tim Spa (Staff, Terapis, dll) ────────────
                Forms\Components\Section::make('💆‍♀️ Tim Terapis & Staff')
                    ->description('Daftar dokter dan staf yang akan ditampilkan di halaman Tentang Kami.')
                    ->schema([
                        Forms\Components\Repeater::make('tim_klinik')
                            ->label('Anggota Tim')
                            ->schema([
                                Forms\Components\FileUpload::make('foto')
                                    ->label('Foto Profil')
                                    ->image()
                                    ->directory('tim')
                                    ->disk('public')
                                    ->maxSize(2048)
                                    ->imageEditor()
                                    ->columnSpanFull()
                                    ->fetchFileInformation(false),
                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Lengkap')
                                    ->required(),
                                Forms\Components\TextInput::make('jabatan')
                                    ->label('Jabatan / Posisi')
                                    ->placeholder('Cth: Dokter Spesialis Kandungan')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('+ Tambah Anggota Tim')
                            ->reorderableWithButtons()
                    ]),

                // ── Jam Operasional ────────────────────────────
                Forms\Components\Section::make('🕐 Jam Operasional')
                    ->schema([
                        Forms\Components\Repeater::make('jam_operasional')
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('hari')
                                    ->label('Hari')
                                    ->placeholder('Senin – Jumat')
                                    ->required(),

                                Forms\Components\TextInput::make('jam')
                                    ->label('Jam Operasional')
                                    ->placeholder('08:00 – 20:00')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('+ Tambah Jam Operasional')
                            ->defaultItems(3),
                    ]),

                // ── Media Sosial ───────────────────────────────
                Forms\Components\Section::make('📱 Media Sosial')
                    ->schema([
                        Forms\Components\TextInput::make('media_sosial.facebook')
                            ->label('Facebook URL')
                            ->url()
                            ->prefix('https://'),

                        Forms\Components\TextInput::make('media_sosial.instagram')
                            ->label('Instagram URL')
                            ->url()
                            ->prefix('https://'),

                        Forms\Components\TextInput::make('media_sosial.youtube')
                            ->label('YouTube URL')
                            ->url()
                            ->prefix('https://'),

                        Forms\Components\TextInput::make('media_sosial.tiktok')
                            ->label('TikTok URL')
                            ->url()
                            ->prefix('https://'),
                    ])->columns(2),

                // ── SEO ────────────────────────────────────────
                Forms\Components\Section::make('🔍 SEO & Analytics')
                    ->schema([
                        Forms\Components\TextInput::make('meta_seo.keywords')
                            ->label('Meta Keywords')
                            ->helperText('Pisahkan dengan koma. Contoh: spa, wellness, massage, perawatan tubuh.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('meta_seo.author')
                            ->label('Meta Author'),

                        Forms\Components\TextInput::make('meta_seo.google_analytics')
                            ->label('Google Analytics ID')
                            ->placeholder('G-XXXXXXXXXX'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Hilangkan key placeholder agar tidak tersimpan ke DB
        unset($data['logo_info'], $data['favicon_info']);

        $setting = PengaturanModel::getSetting();

        // Pertahankan nilai logo/favicon/gambar_og yang ada (tidak diubah di form ini)
        $data['logo']      = $setting->logo;
        $data['favicon']   = $setting->favicon;
        $data['gambar_og'] = $setting->gambar_og;

        $setting->update($data);

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();

        $this->redirect(static::getUrl(), navigate: false);
    }

    protected function getHeaderActions(): array
    {
        return [
            // ── Upload Logo ────────────────────────────────────
            Action::make('uploadLogo')
                ->label('Upload Logo')
                ->icon('heroicon-o-photo')
                ->color('info')
                ->form([
                    Forms\Components\FileUpload::make('logo')
                        ->label('Logo Spa')
                        ->image()
                        ->directory('pengaturan')
                        ->disk('public')
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/svg+xml', 'image/webp'])
                        ->helperText('Rekomendasi: PNG transparan, maks 2MB'),
                ])
                ->modalHeading('Upload Logo')
                ->modalSubmitActionLabel('Simpan Logo')
                ->modalWidth('md')
                ->action(function (array $data): void {
                    $setting = PengaturanModel::getSetting();

                    // Hapus file lama jika ada
                    if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                        Storage::disk('public')->delete($setting->logo);
                    }

                    $setting->update(['logo' => $data['logo']]);

                    Notification::make()
                        ->title('Logo berhasil diupload!')
                        ->success()
                        ->send();

                    $this->redirect(static::getUrl(), navigate: false);
                }),

            // ── Upload Favicon ─────────────────────────────────
            Action::make('uploadFavicon')
                ->label('Upload Favicon')
                ->icon('heroicon-o-star')
                ->color('info')
                ->form([
                    Forms\Components\FileUpload::make('favicon')
                        ->label('Favicon')
                        ->image()
                        ->directory('pengaturan')
                        ->disk('public')
                        ->maxSize(512)
                        ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/vnd.microsoft.icon', 'image/jpeg'])
                        ->helperText('PNG atau ICO 32x32px, maks 512KB'),
                ])
                ->modalHeading('Upload Favicon')
                ->modalSubmitActionLabel('Simpan Favicon')
                ->modalWidth('md')
                ->action(function (array $data): void {
                    $setting = PengaturanModel::getSetting();

                    if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                        Storage::disk('public')->delete($setting->favicon);
                    }

                    $setting->update(['favicon' => $data['favicon']]);

                    Notification::make()
                        ->title('Favicon berhasil diupload!')
                        ->success()
                        ->send();

                    $this->redirect(static::getUrl(), navigate: false);
                }),

            // ── Upload Gambar OG ───────────────────────────────
            Action::make('uploadGambarOg')
                ->label('Upload Gambar OG')
                ->icon('heroicon-o-share')
                ->color('gray')
                ->form([
                    Forms\Components\FileUpload::make('gambar_og')
                        ->label('Gambar OG (Open Graph)')
                        ->image()
                        ->directory('pengaturan')
                        ->disk('public')
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                        ->helperText('Ideal 1200x630px untuk share media sosial'),
                ])
                ->modalHeading('Upload Gambar OG (Open Graph)')
                ->modalSubmitActionLabel('Simpan Gambar')
                ->modalWidth('md')
                ->action(function (array $data): void {
                    $setting = PengaturanModel::getSetting();

                    if ($setting->gambar_og && Storage::disk('public')->exists($setting->gambar_og)) {
                        Storage::disk('public')->delete($setting->gambar_og);
                    }

                    $setting->update(['gambar_og' => $data['gambar_og']]);

                    Notification::make()
                        ->title('Gambar OG berhasil diupload!')
                        ->success()
                        ->send();

                    $this->redirect(static::getUrl(), navigate: false);
                }),

            // ── Upload Background Hero ─────────────────────────
            Action::make('uploadGambarHero')
                ->label('Upload Background Hero')
                ->icon('heroicon-o-photo')
                ->color('info')
                ->form([
                    Forms\Components\FileUpload::make('gambar_hero')
                        ->label('Gambar Background Hero')
                        ->image()
                        ->directory('pengaturan')
                        ->disk('public')
                        ->maxSize(5120)
                        ->helperText('Disarankan gambar beresolusi tinggi (min 1920x1080px), orientasi landscape. Maks 5MB.')
                        ->required()
                        ->fetchFileInformation(false),
                ])
                ->modalHeading('Upload Background Hero (Beranda)')
                ->modalSubmitActionLabel('Simpan Gambar')
                ->modalWidth('md')
                ->action(function (array $data): void {
                    $setting = PengaturanModel::getSetting();

                    if ($setting->gambar_hero && Storage::disk('public')->exists($setting->gambar_hero)) {
                        Storage::disk('public')->delete($setting->gambar_hero);
                    }

                    $setting->update(['gambar_hero' => $data['gambar_hero']]);

                    Notification::make()
                        ->title('Background Hero berhasil diupload!')
                        ->success()
                        ->send();

                    $this->redirect(static::getUrl(), navigate: false);
                }),

            // ── Ganti Password ─────────────────────────────────
            Action::make('gantiPassword')
                ->label('Ganti Password')
                ->icon('heroicon-o-lock-closed')
                ->color('warning')
                ->form([
                    Forms\Components\TextInput::make('password_lama')
                        ->label('Password Saat Ini')
                        ->password()
                        ->revealable()
                        ->required()
                        ->rules([
                            function () {
                                return function (string $attribute, $value, $fail) {
                                    if (!Hash::check($value, Auth::user()->password)) {
                                        $fail('Password saat ini tidak sesuai.');
                                    }
                                };
                            },
                        ]),

                    Forms\Components\TextInput::make('password_baru')
                        ->label('Password Baru')
                        ->password()
                        ->revealable()
                        ->required()
                        ->rule(Password::min(8))
                        ->different('password_lama')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('password_baru_confirmation')
                        ->label('Konfirmasi Password Baru')
                        ->password()
                        ->revealable()
                        ->required()
                        ->same('password_baru')
                        ->maxLength(255),
                ])
                ->modalHeading('Ganti Password')
                ->modalDescription('Masukkan password saat ini dan password baru Anda.')
                ->modalSubmitActionLabel('Simpan Password')
                ->modalWidth('lg')
                ->action(function (array $data): void {
                    Auth::user()->update([
                        'password' => Hash::make($data['password_baru']),
                    ]);

                    Notification::make()
                        ->title('Password berhasil diubah!')
                        ->success()
                        ->send();
                }),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save')
                ->color('primary'),
        ];
    }
}
