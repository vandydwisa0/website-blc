<!-- use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ManagerSeeder
{
    public function run()
    {
        $serviceAccount = ServiceAccount::fromArray([
            'type' => 'service_account',
            'project_id' => 'your-project-id',
            'private_key_id' => 'your-private-key-id',
            'private_key' => 'your-private-key',
            'client_email' => 'your-client-email',
            'client_id' => 'your-client-id',
            'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
            'token_uri' => 'https://accounts.google.com/o/oauth2/token',
            'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
            'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/your-client-email'
        ]);

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://your-firebase-database-url.firebaseio.com') // Ganti dengan URL Firebase Database Anda
            ->create();

        $auth = $firebase->getAuth();
        $email = 'manager@example.com'; // Ganti dengan alamat email manajer yang ingin Anda daftarkan
        $password = 'password123'; // Ganti dengan kata sandi manajer yang ingin Anda gunakan

        try {
            // Buat akun manajer menggunakan email dan kata sandi
            $user = $auth->createUserWithEmailAndPassword($email, $password);

            // Set atribut khusus manajer (jika diperlukan)
            $user->updateProfile([
                'displayName' => 'Nama Manajer', // Ganti dengan nama lengkap manajer
                // Tambahkan atribut lain yang sesuai dengan kebutuhan Anda
            ]);

            // Simpan data manajer ke Firestore (jika diperlukan)
            $usersCollection = $firebase->getFirestore()->collection('users');
            $usersCollection->document($user->uid)->set([
                'email' => $email,
                'role' => 'manager',
                // Tambahkan data lain yang sesuai dengan kebutuhan Anda
            ]);

            echo "Akun manajer berhasil dibuat.\n";
        } catch (\Kreait\Firebase\Exception\Auth\EmailExists $e) {
            echo "Akun manajer sudah ada dengan alamat email yang sama.\n";
        } catch (\Exception $e) {
            echo "Gagal membuat akun manajer: " . $e->getMessage() . "\n";
        }
    }
} -->