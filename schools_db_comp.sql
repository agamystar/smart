-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2014 at 09:40 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schools_db_comp`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
  `user_id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absence`
--

INSERT INTO `absence` (`user_id`, `day`) VALUES
(68, '2014/09/28'),
(71, '2014/09/28'),
(380, '2014/09/28'),
(395, '2014/09/28'),
(399, '2014/09/28'),
(403, '2014/09/28'),
(558, '2014/09/28'),
(59, '2014/09/29'),
(379, '2014/09/29'),
(397, '2014/09/29'),
(398, '2014/09/29'),
(400, '2014/09/29'),
(401, '2014/09/29'),
(499, '2014/09/29'),
(503, '2014/09/29'),
(510, '2014/09/29'),
(528, '2014/09/29');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`) VALUES
(1, 'Mr. Admin', 'school@smart.com.eg', '123456', '1');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
`book_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `author` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `name`, `description`, `author`, `class_id`, `status`, `price`) VALUES
(1, '7 Habits ', 'Human Development ', 'Steven Covey ', '1', 'available', '20');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `no` varchar(11) NOT NULL,
  `driver` varchar(100) NOT NULL,
  `supervisor` varchar(100) NOT NULL,
  `path` varchar(300) NOT NULL,
  `student_fees` int(11) NOT NULL,
  `school_fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`no`, `driver`, `supervisor`, `path`, `student_fees`, `school_fees`) VALUES
('A1000', 'samy', 'ahmed', 'fayoum - 6 october', 9000, 900),
('G20000', 'alaa', 'mohsen', 'a-b-c', 2000, 20000),
('H700', 'ali', 'mohamed ali', 'cairo - giza', 4000, 8000),
('Z1000', 'mohamed', 'ali fouad', 'giza - cairo', 1000, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `bus_absence`
--

CREATE TABLE IF NOT EXISTS `bus_absence` (
  `student_id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bus_students`
--

CREATE TABLE IF NOT EXISTS `bus_students` (
  `bus_no` varchar(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_students`
--

INSERT INTO `bus_students` (`bus_no`, `student_id`) VALUES
('G20000', 46),
('z1000', 59),
('z1000', 68),
('z1000', 71),
('z1000', 378),
('z1000', 379),
('A1000', 381),
('A1000', 395),
('A1000', 399);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`class_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name_numeric` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `stage` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `name`, `name_numeric`, `stage`, `level`, `teacher_id`) VALUES
(1, 'A', '222', '1', '1', 64),
(2, 'B', '2', '2', '1', 391),
(3, 'C', '3', '2', '3', 393),
(4, 'D1', '4', '2', '1', 392),
(5, 'B322', '5', '2', '3', 64);

-- --------------------------------------------------------

--
-- Table structure for table `class_routine`
--

CREATE TABLE IF NOT EXISTS `class_routine` (
`class_routine_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `day` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `class_routine`
--

INSERT INTO `class_routine` (`class_routine_id`, `class_id`, `subject_id`, `time_start`, `time_end`, `day`) VALUES
(1, 1, 1, 8, 9, 'sunday'),
(2, 1, 2, 9, 10, 'sunday'),
(3, 1, 3, 10, 11, 'sunday'),
(4, 1, 3, 2, 11, 'friday');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE IF NOT EXISTS `class_students` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_students`
--

INSERT INTO `class_students` (`class_id`, `student_id`) VALUES
(1, 59),
(1, 68),
(1, 71),
(1, 378),
(1, 379),
(1, 380),
(1, 381),
(1, 382),
(1, 383),
(1, 384),
(1, 385),
(1, 394),
(1, 395),
(1, 396),
(1, 397),
(1, 398),
(1, 399),
(1, 400),
(1, 401),
(1, 402),
(1, 403),
(1, 404),
(1, 405),
(1, 495),
(1, 499),
(1, 503),
(1, 506),
(1, 510),
(1, 514),
(1, 517),
(1, 521),
(2, 524),
(2, 525),
(1, 528),
(1, 532),
(1, 536),
(1, 539),
(1, 543),
(1, 547),
(1, 550),
(1, 554),
(1, 558);

-- --------------------------------------------------------

--
-- Table structure for table `dormitory`
--

CREATE TABLE IF NOT EXISTS `dormitory` (
`dormitory_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number_of_room` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dormitory`
--

INSERT INTO `dormitory` (`dormitory_id`, `name`, `number_of_room`, `description`) VALUES
(1, 'Smart Bulding ', '4', '');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
`email_template_id` int(11) NOT NULL,
  `task` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` longtext COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
`exam_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `name`, `date`, `comment`) VALUES
(1, 'Math Quiz', '06/12/2014', 'For All students in Grade 2');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `stage` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `level`, `stage`, `value`) VALUES
(1, 'school fees', 1, 1, 9000),
(2, 'books fees', 1, 1, 400),
(3, 'clothes fees', 1, 1, 700);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `name`) VALUES
(100, 'student'),
(200, 'teacher'),
(300, 'parent');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`grade_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `grade_point` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mark_from` int(11) NOT NULL,
  `mark_upto` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `name`, `grade_point`, `mark_from`, `mark_upto`, `comment`) VALUES
(1, 'Very Good', '75', 75, 84, ''),
(2, 'Excellent', '85', 85, 100, ''),
(3, 'Good', '65', 65, 74, '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `show_front` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `show_front`) VALUES
(1, 'admin', 'Administrator', 0),
(2, 'student', 'Student', 1),
(3, 'teacher', 'Teacher\r\n', 1),
(4, 'parent', 'Parents\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE IF NOT EXISTS `installments` (
`id` int(11) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` int(11) NOT NULL,
  `end_date` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `expenses_id`, `name`, `value`, `end_date`) VALUES
(1, 1, 'installment 1', 0, '2014/09/25'),
(2, 1, 'installment 2', 0, '2014/09/25');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
`invoice_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `creation_timestamp` int(11) NOT NULL,
  `payment_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `student_id`, `title`, `description`, `amount`, `creation_timestamp`, `payment_timestamp`, `payment_method`, `payment_details`, `status`) VALUES
(1, 1, 'First Payment ', '', 2000, 1402358400, '', '', '', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
`phrase_id` int(11) NOT NULL,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bengali` longtext COLLATE utf8_unicode_ci NOT NULL,
  `spanish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `arabic` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dutch` longtext COLLATE utf8_unicode_ci NOT NULL,
  `russian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `chinese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `turkish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `portuguese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hungarian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `french` longtext COLLATE utf8_unicode_ci NOT NULL,
  `greek` longtext COLLATE utf8_unicode_ci NOT NULL,
  `german` longtext COLLATE utf8_unicode_ci NOT NULL,
  `italian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `thai` longtext COLLATE utf8_unicode_ci NOT NULL,
  `urdu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hindi` longtext COLLATE utf8_unicode_ci NOT NULL,
  `latin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `indonesian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `japanese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `korean` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=229 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(1, 'login', 'login', 'লগইন', 'login', 'دخول', 'login', 'Войти', '注册', 'giriş', 'login', 'bejelentkezés', 'Connexion', 'σύνδεση', 'Login', 'login', 'เข้าสู่ระบบ', 'لاگ ان', 'लॉगिन', 'login', 'login', 'ログイン', '로그인'),
(2, 'account_type', 'account type', 'অ্যাকাউন্ট টাইপ', 'tipo de cuenta', 'نوع الحساب', 'type account', 'тип счета', '账户类型', 'hesap türü', 'tipo de conta', 'fiók típusát', 'Type de compte', 'τον τύπο του λογαριασμού', 'Kontotyp', 'tipo di account', 'ประเภทบัญชี', 'اکاؤنٹ کی قسم', 'खाता प्रकार', 'propter speciem', 'Jenis akun', '口座の種類', '계정 유형'),
(3, 'admin', 'admin', 'অ্যাডমিন', 'administración', 'مشرف', 'admin', 'админ', '管理', 'yönetim', 'administrador', 'admin', 'administrateur', 'το admin', 'Admin', 'Admin', 'ผู้ดูแลระบบ', 'منتظم', 'प्रशासन', 'Lorem ipsum dolor sit', 'admin', '管理者', '관리자'),
(4, 'teacher', 'teacher', 'শিক্ষক', 'profesor', 'معلم', 'leraar', 'учитель', '老师', 'öğretmen', 'professor', 'tanár', 'professeur', 'δάσκαλος', 'Lehrer', 'insegnante', 'ครู', 'استاد', 'शिक्षक', 'Magister', 'guru', '教師', '선생'),
(5, 'student', 'student', 'ছাত্র', 'estudiante', 'طالب', 'student', 'студент', '学生', 'öğrenci', 'estudante', 'diák', 'étudiant', 'φοιτητής', 'Schüler', 'studente', 'นักเรียน', 'طالب علم', 'छात्र', 'discipulo', 'mahasiswa', '学生', '학생'),
(6, 'parent', 'parent', 'পিতা বা মাতা', 'padre', 'ولي أمر', 'ouder', 'родитель', '亲', 'ebeveyn', 'parente', 'szülő', 'mère', 'μητρική εταιρεία', 'Elternteil', 'genitore', 'ผู้ปกครอง', 'والدین', 'माता - पिता', 'parente', 'induk', '親', '부모의'),
(7, 'email', 'email', 'ইমেইল', 'email', 'البريد الإلكتروني', 'e-mail', 'по электронной почте', '电子邮件', 'E-posta', 'e-mail', 'E-mail', 'email', 'e-mail', 'E-Mail-', 'e-mail', 'อีเมล์', 'ای میل', 'ईमेल', 'email', 'email', 'メール', '이메일'),
(8, 'password', 'password', 'পাসওয়ার্ড', 'contraseña', 'كلمة السر', 'wachtwoord', 'пароль', '密码', 'şifre', 'senha', 'jelszó', 'mot de passe', 'τον κωδικό', 'Passwort', 'password', 'รหัสผ่าน', 'پاس', 'पासवर्ड', 'Signum', 'kata sandi', 'パスワード', '암호'),
(9, 'forgot_password ?', 'forgot password ?', 'পাসওয়ার্ড ভুলে গেছেন?', '¿Olvidó su contraseña?', 'نسيت كلمة المرور؟', 'wachtwoord vergeten?', 'забыли пароль?', '忘记密码？', 'Şifremi unuttum?', 'Esqueceu a senha?', 'Elfelejtett jelszó?', 'Mot de passe oublié?', 'Ξεχάσατε τον κωδικό;', 'Passwort vergessen?', 'dimenticato la password?', 'ลืมรหัสผ่าน', 'پاس ورڈ بھول گیا؟', 'क्या संभावनाएं हैं?', 'oblitus esne verbi?', 'lupa password?', 'パスワードを忘れた？', '비밀번호를 잊으 셨나요?'),
(10, 'reset_password', 'reset password', 'পাসওয়ার্ড রিসেট', 'restablecer la contraseña', 'إعادة تعيين كلمة المرور', 'reset wachtwoord', 'сбросить пароль', '重设密码', 'şifrenizi sıfırlamak', 'redefinir a senha', 'Jelszó visszaállítása', 'réinitialiser le mot de passe', 'επαναφέρετε τον κωδικό πρόσβασης', 'Kennwort zurücksetzen', 'reimpostare la password', 'ตั้งค่ารหัสผ่าน', 'پاس ورڈ ری سیٹ', 'पासवर्ड रीसेट', 'Duis adipiscing', 'reset password', 'パスワードを再設定する', '암호를 재설정'),
(11, 'reset', 'reset', 'রিসেট করুন', 'reajustar', 'إعادة تعيين', 'reset', 'сброс', '重置', 'ayarlamak', 'restabelecer', 'vissza', 'remettre', 'επαναφορά', 'rücksetzen', 'reset', 'ตั้งใหม่', 'ری سیٹ', 'रीसेट करें', 'Duis', 'ulang', 'リセット', '재설정'),
(12, 'admin_dashboard', 'admin dashboard', 'অ্যাডমিন ড্যাশবোর্ড', 'administrador salpicadero', 'المشرف وحة القيادة', 'admin dashboard', 'админ панель', '管理面板', 'Admin paneli', 'Admin Dashboard', 'admin műszerfal', 'administrateur tableau de bord', 'πίνακα ελέγχου του διαχειριστή', 'Admin-Dashboard', 'Admin Dashboard', 'แผงควบคุมของผู้ดูแลระบบ', 'ایڈمن ڈیش بورڈ', 'व्यवस्थापक डैशबोर्ड', 'Lorem ipsum dolor sit Dashboard', 'admin dashboard', '管理ダッシュボード', '관리자 대시 보드'),
(13, 'account', 'account', 'হিসাব', 'cuenta', 'حساب', 'rekening', 'счет', '帐户', 'hesap', 'conta', 'számla', 'compte', 'λογαριασμός', 'Konto', 'conto', 'บัญชี', 'اکاؤنٹ', 'खाता', 'propter', 'rekening', 'アカウント', '계정'),
(14, 'profile', 'profile', 'পরিলেখ', 'perfil', 'ملف', 'profiel', 'профиль', '轮廓', 'profil', 'perfil', 'profil', 'profil', 'προφίλ', 'Profil', 'profilo', 'โปรไฟล์', 'پروفائل', 'रूपरेखा', 'profile', 'profil', 'プロフィール', '프로필'),
(15, 'change_password', 'change password', 'পাসওয়ার্ড পরিবর্তন', 'cambiar la contraseña', 'تغيير كلمة المرور', 'wachtwoord wijzigen', 'изменить пароль', '更改密码', 'şifresini değiştirmek', 'alterar a senha', 'jelszó megváltoztatása', 'changer le mot de passe', 'αλλάξετε τον κωδικό πρόσβασης', 'Kennwort ändern', 'cambiare la password', 'เปลี่ยนรหัสผ่าน', 'پاس ورڈ تبدیل', 'पासवर्ड परिवर्तित', 'mutare password', 'mengubah password', 'パスワードを変更する', '암호를 변경'),
(16, 'logout', 'logout', 'লগ আউট', 'logout', 'تسجيل الخروج', 'logout', 'выход', '注销', 'logout', 'Sair', 'logout', 'Déconnexion', 'αποσύνδεση', 'logout', 'Esci', 'ออกจากระบบ', 'لاگ آؤٹ کریں', 'लॉगआउट', 'logout', 'logout', 'ログアウト', '로그 아웃'),
(17, 'panel', 'panel', 'প্যানেল', 'panel', 'لوحة', 'paneel', 'панель', '面板', 'panel', 'painel', 'bizottság', 'panneau', 'πίνακας', 'Platte', 'pannello', 'แผงหน้าปัด', 'پینل', 'पैनल', 'panel', 'panel', 'パネル', '패널'),
(18, 'dashboard_help', 'dashboard help', 'ড্যাশবোর্ড সহায়তা', 'salpicadero ayuda', 'مساعدة لوحة التحكم ', 'dashboard hulp', 'Приборная панель помощь', '仪表板帮助', 'pano yardım', 'dashboard ajuda', 'műszerfal help', 'tableau de bord aide', 'ταμπλό βοήθεια', 'Dashboard-Hilfe', 'dashboard aiuto', 'แผงควบคุมความช่วยเหลือ', 'ڈیش بورڈ مدد', 'डैशबोर्ड मदद', 'Dashboard auxilium', 'dashboard bantuan', 'ダッシュボードヘルプ', '대시 보드 도움말'),
(19, 'dashboard', 'dashboard', 'ড্যাশবোর্ড', 'salpicadero', 'لوحة التحكم ', 'dashboard', 'приборная панель', '仪表盘', 'gösterge paneli', 'painel de instrumentos', 'műszerfal', 'tableau de bord', 'ταμπλό', 'Armaturenbrett', 'cruscotto', 'หน้าปัด', 'ڈیش بورڈ', 'डैशबोर्ड', 'Dashboard', 'dasbor', 'ダッシュボード', '계기판'),
(20, 'student_help', 'student help', 'শিক্ষার্থীর সাহায্য', 'ayuda estudiantil', 'مساعدة الطالب', 'student hulp', 'студент помощь', '学生的帮助', 'Öğrenci yardım', 'ajuda estudante', 'diák segítségével', 'aide aux étudiants', 'φοιτητής βοήθεια', 'Schüler-Hilfe', 'help studente', 'ช่วยเหลือนักเรียน', 'طالب علم کی مدد', 'छात्र मदद', 'Discipulus auxilium', 'membantu siswa', '学生のヘルプ', '학생 도움말'),
(21, 'teacher_help', 'teacher help', 'শিক্ষক সাহায্য', 'ayuda del maestro', 'مساعدة المعلم', 'leraar hulp', 'Учитель помощь', '老师的帮助', 'öğretmen yardım', 'ajuda de professores', 'tanár segítségével', 'aide de l''enseignant', 'βοήθεια των εκπαιδευτικών', 'Lehrer-Hilfe', 'aiuto dell''insegnante', 'ครูช่วยเหลือ', 'استاد کی مدد', 'शिक्षक मदद', 'doctor auxilium', 'bantuan guru', '教師のヘルプ', '교사의 도움'),
(22, 'subject_help', 'subject help', 'বিষয় সাহায্য', 'ayuda sujeto', 'مساعدة الموضوع', 'Onderwerp hulp', 'Заголовок помощь', '主题帮助', 'konusu yardım', 'ajuda assunto', 'tárgy segítségével', 'l''objet de l''aide', 'υπόκεινται βοήθεια', 'Thema Hilfe', 'Aiuto Subject', 'ความช่วยเหลือเรื่อง', 'موضوع مدد', 'विषय मदद', 'agitur salus', 'bantuan subjek', '件名ヘルプ', '주제 도움'),
(23, 'subject', 'subject', 'বিষয়', 'sujeto', 'موضوع', 'onderwerp', 'тема', '主题', 'konu', 'assunto', 'tárgy', 'sujet', 'θέμα', 'Thema', 'soggetto', 'เรื่อง', 'موضوع', 'विषय', 'agitur', 'subyek', 'テーマ', '제목'),
(24, 'class_help', 'class help', 'বর্গ সাহায্য', 'clase de ayuda', 'الطبقة مساعدة', 'klasse hulp', 'Класс помощь', '类的帮助', 'sınıf yardım', 'classe ajuda', 'osztály segítségével', 'aide de la classe', 'Κατηγορία βοήθεια', 'Klasse Hilfe', 'help classe', 'ความช่วยเหลือในชั้นเรียน', 'کلاس مدد', 'कक्षा मदद', 'genus auxilii', 'kelas bantuan', 'クラスのヘルプ', '클래스 도움'),
(25, 'class', 'class', 'বর্গ', 'clase', 'فصل ', 'klasse', 'класс', '类', 'sınıf', 'classe', 'osztály', 'classe', 'κατηγορία', 'Klasse', 'classe', 'ชั้น', 'کلاس', 'वर्ग', 'class', 'kelas', 'クラス', '클래스'),
(26, 'exam_help', 'exam help', 'পরীক্ষায় সাহায্য', 'ayuda examen', 'مساعدة الامتحان ', 'examen hulp', 'Экзамен помощь', '考试帮助', 'sınav yardım', 'exame ajuda', 'vizsga help', 'aide à l''examen', 'εξετάσεις βοήθεια', 'Prüfung Hilfe', 'esame di guida', 'การสอบความช่วยเหลือ', 'امتحان مدد', 'परीक्षा मदद', 'ipsum Auxilium', 'ujian bantuan', '試験ヘルプ', '시험에 도움'),
(27, 'exam', 'exam', 'পরীক্ষা', 'examen', 'امتحان', 'tentamen', 'экзамен', '考试', 'sınav', 'exame', 'vizsgálat', 'exam', 'εξέταση', 'Prüfung', 'esame', 'การสอบ', 'امتحان', 'परीक्षा', 'Lorem ipsum', 'ujian', '試験', '시험'),
(28, 'marks_help', 'marks help', 'চিহ্ন সাহায্য', 'marcas ayudan', 'علامات مساعدة', 'markeringen helpen', 'метки помогают', '标记帮助', 'işaretleri yardım', 'marcas ajudar', 'jelek segítenek', 'marques aident', 'σήματα βοηθήσει', 'Markierungen helfen', 'segni aiutano', 'เครื่องหมายช่วย', 'نمبر مدد', 'निशान मदद', 'notas auxilio', 'tanda membantu', 'マークのヘルプ', '마크는 데 도움이'),
(29, 'marks-attendance', 'marks-attendance', 'চিহ্ন-উপস্থিতির', 'marcas-asistencia', 'الغياب والحضور', 'merken-deelname', 'знаки-посещаемости', '标记缺席', 'işaretleri-katılım', 'marcas de comparecimento', 'jelek-ellátás', 'marques-participation', 'σήματα προσέλευση', 'Marken-Teilnahme', 'marchi-presenze', 'เครื่องหมายการเข้าร่วม', 'نمبر حاضری', 'निशान उपस्थिति', 'signa eius ministrabant,', 'tanda-pertemuan', 'マーク·出席', '마크 출석'),
(30, 'grade_help', 'grade help', 'গ্রেড সাহায্য', 'ayuda de grado', 'مساعدة الصف', 'leerjaar hulp', 'оценка помощь', '级帮助', 'sınıf yardım', 'ajuda grau', 'fokozat help', 'aide de qualité', 'βαθμού βοήθεια', 'Grade-Hilfe', 'aiuto grade', 'ช่วยเหลือเกรด', 'گریڈ مدد', 'ग्रेड मदद', 'gradus ope', 'kelas bantuan', 'グレードのヘルプ', '급 도움'),
(31, 'exam-grade', 'exam-grade', 'পরীক্ষার শ্রেণী', 'examen de grado', 'امتحان الصف', 'examen-grade', 'экзамен класса', '考试级别', 'sınav notu', 'exame de grau', 'vizsga-grade', 'examen de qualité', 'εξετάσεις ποιότητας', 'Prüfung-Grade', 'esami-grade', 'สอบเกรด', 'امتحان گریڈ', 'परीक्षा ग्रेड', 'ipsum turpis,', 'ujian-grade', '試験グレード', '시험 등급'),
(32, 'class_routine_help', 'class routine help', 'ক্লাসের রুটিন সাহায্য', 'clase ayuda rutina', 'مساعدة روتينية للفصل ', 'klasroutine hulp', 'класс рутина помощь', '类常规帮助', 'sınıf rutin yardım', 'classe ajuda rotina', 'osztály rutin segít', 'classe aide routine', 'κατηγορία ρουτίνας βοήθεια', 'Klasse Routine Hilfe', 'Classe aiuto di routine', 'ระดับความช่วยเหลือตามปกติ', 'کلاس معمول مدد', 'वर्ग दिनचर्या मदद', 'uno genere auxilium', 'kelas bantuan rutin', 'クラスルーチンのヘルプ', '클래스 루틴 도움'),
(33, 'class_routine', 'class Timetable', 'ক্লাসের রুটিন', 'rutina de la clase', 'الجدول المدرسي', 'klasroutine', 'класс подпрограмм', '常规类', 'sınıf rutin', 'rotina classe', 'osztály rutin', 'routine de classe', 'Κατηγορία ρουτίνα', 'Klasse Routine', 'classe di routine', 'ประจำชั้น', 'کلاس معمول', 'वर्ग दिनचर्या', 'in genere uno,', 'rutin kelas', 'クラス·ルーチン', '클래스 루틴'),
(34, 'invoice_help', 'invoice help', 'চালান সাহায্য', 'ayuda factura', 'مساعدة الفاتورة', 'factuur hulp', 'счет-фактура помощь', '发票帮助', 'fatura yardım', 'ajuda factura', 'számla segítségével', 'aide facture', 'τιμολόγιο βοήθεια', 'Rechnungs Hilfe', 'help fattura', 'ช่วยเหลือใบแจ้งหนี้', 'انوائس مدد', 'चालान सहायता', 'auxilium cautionem', 'bantuan faktur', '送り状ヘルプ', '송장 도움'),
(35, 'payment', 'payment', 'প্রদান', 'pago', 'المصروفات المدرسية ', 'betaling', 'оплата', '付款', 'ödeme', 'pagamento', 'fizetés', 'paiement', 'πληρωμή', 'Zahlung', 'pagamento', 'การชำระเงิน', 'ادائیگی', 'भुगतान', 'pecunia', 'pembayaran', '支払い', '지불'),
(36, 'book_help', 'book help', 'বইয়ের সাহায্য', 'libro de ayuda', 'كتاب المساعدة', 'boek hulp', 'Книга помощь', '本书帮助', 'kitap yardımı', 'livro ajuda', 'könyv segít', 'livre aide', 'βοήθεια του βιβλίου', 'Buch-Hilfe', 'della guida', 'ช่วยเหลือหนังสือ', 'کتاب مدد', 'पुस्तक मदद', 'auxilium libro,', 'Buku bantuan', 'ブックのヘルプ', '책 도움말'),
(37, 'library', 'library', 'লাইব্রেরি', 'biblioteca', 'مكتبة', 'bibliotheek', 'библиотека', '文库', 'kütüphane', 'biblioteca', 'könyvtár', 'bibliothèque', 'βιβλιοθήκη', 'Bibliothek', 'biblioteca', 'ห้องสมุด', 'لائبریری', 'पुस्तकालय', 'library', 'perpustakaan', '図書館', '도서관'),
(38, 'transport_help', 'transport help', 'যানবাহনের সাহায্য', 'ayuda de transporte', 'مساعدة النقل', 'vervoer help', 'транспорт помощь', '运输帮助', 'ulaşım yardım', 'ajuda de transporte', 'szállítás Súgó', 'le transport de l''aide', 'βοηθούν τη μεταφορά', 'Transport Hilfe', 'help trasporti', 'ช่วยเหลือการขนส่ง', 'نقل و حمل مدد', 'परिवहन मदद', 'auxilium onerariis', 'transportasi bantuan', '輸送のヘルプ', '전송 도움'),
(39, 'transport', 'transport', 'পরিবহন', 'transporte', 'نقل', 'vervoer', 'транспорт', '运输', 'taşıma', 'transporte', 'szállítás', 'transport', 'μεταφορά', 'Transport', 'trasporto', 'การขนส่ง', 'نقل و حمل', 'परिवहन', 'onerariis', 'angkutan', '輸送', '수송'),
(40, 'dormitory_help', 'dormitory help', 'আস্তানা সাহায্য', 'dormitorio de ayuda', 'عنبر المساعدة', 'slaapzaal hulp', 'общежитие помощь', '宿舍帮助', 'yatakhane yardım', 'dormitório ajuda', 'kollégiumi help', 'dortoir aide', 'κοιτώνα βοήθεια', 'Wohnheim Hilfe', 'dormitorio aiuto', 'หอพักช่วยเหลือ', 'شیناگار مدد', 'छात्रावास मदद', 'dormitorium auxilium', 'asrama bantuan', '寮のヘルプ', '기숙사 도움말'),
(41, 'dormitory', 'Hostal ', 'শ্রমিক - আস্তানা', 'dormitorio', 'الإقامة', 'slaapzaal', 'спальня', '宿舍', 'yatakhane', 'dormitório', 'hálóterem', 'dortoir', 'κοιτώνα', 'Wohnheim', 'dormitorio', 'หอพัก', 'شیناگار', 'छात्रावास', 'dormitorium', 'asrama mahasiswa', '寮', '기숙사'),
(42, 'noticeboard_help', 'noticeboard help', 'নোটিশবোর্ড সাহায্য', 'tablón de anuncios de la ayuda', 'اللافتة مساعدة', 'prikbord hulp', 'доска для объявлений помощь', '布告帮助', 'noticeboard yardım', 'avisos ajuda', 'üzenőfalán help', 'panneau d''aide', 'ανακοινώσεων βοήθεια', 'Brett-Hilfe', 'bacheca aiuto', 'ป้ายประกาศความช่วยเหลือ', 'noticeboard مدد', 'Noticeboard मदद', 'auxilium noticeboard', 'pengumuman bantuan', '伝言板のヘルプ', '의 noticeboard 도움말'),
(43, 'noticeboard-event', 'noticeboard-event', 'নোটিশবোর্ড-ইভেন্ট', 'tablón de anuncios de eventos', 'اللافتة الحدث', 'prikbord-event', 'доска для объявлений-событие', '布告牌事件', 'noticeboard olay', 'avisos de eventos', 'üzenőfalán esemény', 'panneau d''événement', 'ανακοινώσεων εκδήλωση', 'Brett-Ereignis', 'bacheca-evento', 'ป้ายประกาศของเหตุการณ์', 'noticeboard ایونٹ', 'Noticeboard घटना', 'noticeboard eventus,', 'pengumuman-acara', '伝言板イベント', '의 noticeboard 이벤트'),
(44, 'bed_ward_help', 'bed ward help', 'বিছানা ওয়ার্ড সাহায্য', 'cama ward ayuda', 'جناح سرير المساعدة', 'bed ward hulp', 'кровать подопечный помощь', '床病房的帮助', 'yatak koğuş yardım', 'ajuda cama enfermaria', 'ágy Ward help', 'lit salle de l''aide', 'κρεβάτι πτέρυγα βοήθεια', 'Betten-Station Hilfe', 'Letto reparto aiuto', 'วอร์ดเตียงช่วยเหลือ', 'بستر وارڈ مدد', 'बिस्तर वार्ड मदद', 'lectum stans auxilium', 'tidur bangsal bantuan', 'ベッド病棟のヘルプ', '침대 병동 도움'),
(45, 'settings', 'settings', 'সেটিংস', 'configuración', 'إعدادات', 'instellingen', 'настройки', '设置', 'ayarları', 'definições', 'beállítások', 'paramètres', 'Ρυθμίσεις', 'Einstellungen', 'Impostazioni', 'การตั้งค่า', 'ترتیبات', 'सेटिंग्स', 'occasus', 'Pengaturan', '設定', '설정'),
(46, 'system_settings', 'system settings', 'সিস্টেম সেটিংস', 'configuración del sistema', 'إعدادات النظام', 'systeeminstellingen', 'настройки системы', '系统设置', 'sistem ayarları', 'configurações do sistema', 'rendszerbeállításokat', 'les paramètres du système', 'ρυθμίσεις του συστήματος', 'Systemeinstellungen', 'impostazioni di sistema', 'การตั้งค่าระบบ', 'نظام کی ترتیبات', 'प्रणाली सेटिंग्स', 'ratio occasus', 'pengaturan sistem', 'システム設定', '시스템 설정'),
(47, 'manage_language', 'manage language', 'ভাষা ও পরিচালনা', 'gestionar idioma', 'إدارة اللغة', 'beheren taal', 'управлять язык', '管理语言', 'dil yönetmek', 'gerenciar língua', 'kezelni nyelv', 'gérer langue', 'διαχείριση γλώσσα', 'verwalten Sprache', 'gestire lingua', 'จัดการภาษา', 'زبان کا انتظام', 'भाषा का प्रबंधन', 'moderari linguam,', 'mengelola bahasa', '言語を管理', '언어를 관리'),
(48, 'backup_restore', 'backup restore', 'ব্যাকআপ পুনঃস্থাপন', 'copia de seguridad a restaurar', 'استعادة النسخ الاحتياطي', 'backup terugzetten', 'восстановить резервного копирования', '备份还原', 'yedekleme geri', 'de backup restaurar', 'Backup Restore', 'restauration de sauvegarde', 'επαναφοράς αντιγράφων ασφαλείας', 'Backup wiederherstellen', 'ripristino di backup', 'การสำรองข้อมูลเรียกคืน', 'بیک اپ بحال', 'बैकअप बहाल', 'tergum restituunt', 'backup restore', 'バックアップは、リストア', '백업 복원'),
(49, 'profile_help', 'profile help', 'সাহায্য প্রোফাইল', 'Perfil Ayuda', 'ملف المساعدة', 'profile hulp', 'анкета помощь', '简介帮助', 'yardım profile', 'Perfil ajuda', 'profile help', 'profil aide', 'προφίλ βοήθεια', 'Profil Hilfe', 'profilo di aiuto', 'โปรไฟล์ความช่วยเหลือ', 'مدد پروفائل', 'प्रोफाइल में', 'Auctor nullam opem', 'Profil bantuan', 'プロフィールヘルプ', '도움 프로필'),
(50, 'manage_student', 'manage student', 'শিক্ষার্থী ও পরিচালনা', 'gestionar estudiante', 'إدارة الطلبة', 'beheren student', 'управлять студента', '管理学生', 'öğrenci yönetmek', 'gerenciar estudante', 'kezelni diák', 'gérer étudiant', 'διαχείριση των φοιτητών', 'Schüler verwalten', 'gestire studente', 'การจัดการศึกษา', 'طالب علم کا انتظام', 'छात्र का प्रबंधन', 'curo alumnorum', 'mengelola siswa', '生徒を管理', '학생 관리'),
(51, 'manage_teacher', 'manage teacher', 'শিক্ষক ও পরিচালনা', 'gestionar maestro', 'إدارة المعلم', 'beheren leraar', 'управлять учителя', '管理老师', 'öğretmen yönetmek', 'gerenciar professor', 'kezelni tanár', 'gérer enseignant', 'διαχείριση των εκπαιδευτικών', 'Lehrer verwalten', 'gestire insegnante', 'จัดการครู', 'ٹیچر کا انتظام', 'शिक्षक का प्रबंधन', 'magister curo', 'mengelola guru', '教師を管理', '교사 관리'),
(52, 'noticeboard', 'noticeboard', 'নোটিশবোর্ড', 'tablón de anuncios', 'اللافتة', 'prikbord', 'доска для объявлений', '布告', 'noticeboard', 'quadro de avisos', 'üzenőfalán', 'panneau d''affichage', 'ανακοινώσεων', 'Brett', 'bacheca', 'ป้ายประกาศ', 'noticeboard', 'Noticeboard', 'noticeboard', 'pengumuman', '伝言板', '의 noticeboard'),
(53, 'language', 'language', 'ভাষা', 'idioma', 'لغة', 'taal', 'язык', '语', 'dil', 'língua', 'nyelv', 'langue', 'γλώσσα', 'Sprache', 'lingua', 'ภาษา', 'زبان', 'भाषा', 'Lingua', 'bahasa', '言語', '언어'),
(54, 'backup', 'backup', 'ব্যাকআপ', 'reserva', 'دعم', 'reservekopie', 'резервный', '备用', 'yedek', 'backup', 'mentés', 'sauvegarde', 'εφεδρικός', 'Sicherungskopie', 'di riserva', 'การสำรองข้อมูล', 'بیک اپ', 'बैकअप', 'tergum', 'backup', 'バックアップ', '지원'),
(55, 'calendar_schedule', 'calendar schedule', 'ক্যালেন্ডার সময়সূচী', 'horario de calendario', 'الجدول الزمني', 'kalender schema', 'Календарь Расписание', '日历日程', 'takvim programı', 'agenda calendário', 'naptári ütemezés', 'calendrier calendrier', 'χρονοδιαγράμματος του ημερολογίου', 'Kalender Zeitplan', 'programma di calendario', 'ปฏิทินตารางนัดหมาย', 'کیلنڈر شیڈول', 'कैलेंडर अनुसूची', 'kalendarium ipsum', 'jadwal kalender', 'カレンダーのスケジュール', '캘린더 일정'),
(56, 'select_a_class', 'select a class', 'একটি শ্রেণী নির্বাচন', 'seleccionar una clase', 'أختر الفصل ', 'selecteer een class', 'выберите класс', '选择一个类', 'bir sınıf seçin', 'selecionar uma classe', 'válasszon ki egy osztályt', 'sélectionner une classe', 'επιλέξτε μια κατηγορία', 'Wählen Sie eine Klasse', 'selezionare una classe', 'เลือกชั้น', 'ایک کلاس منتخب کریں', 'एक वर्ग का चयन करें', 'eligere genus', 'pilih kelas', 'クラスを選択', '클래스를 선택'),
(57, 'student_list', 'student list', 'শিক্ষার্থীর তালিকা', 'lista de alumnos', 'قائمة الطلاب', 'student lijst', 'Список студент', '学生名单', 'öğrenci listesi', 'lista de alunos', 'diák lista', 'liste des étudiants', 'κατάλογο των φοιτητών', 'Schülerliste', 'elenco degli studenti', 'รายชื่อนักเรียน', 'طالب علم کی فہرست', 'छात्र सूची', 'Discipulus album', 'daftar mahasiswa', '学生のリスト', '학생 목록'),
(58, 'add_student', 'add student', 'ছাত্র যোগ', 'añadir estudiante', 'إضافة طالب', 'voeg student', 'добавить студента', '新增学生', 'öğrenci eklemek', 'adicionar estudante', 'hozzá hallgató', 'ajouter étudiant', 'προσθέστε φοιτητής', 'Student hinzufügen', 'aggiungere studente', 'เพิ่มนักเรียน', 'طالب علم شامل', 'छात्र जोड़', 'adde elit', 'menambahkan mahasiswa', '学生を追加', '학생을 추가'),
(59, 'roll', 'roll', 'রোল', 'rollo', 'استبيان', 'broodje', 'рулон', '滚', 'rulo', 'rolo', 'tekercs', 'rouleau', 'ρολό', 'Rolle', 'rotolo', 'ม้วน', 'رول', 'रोल', 'volumen', 'gulungan', 'ロール', '롤'),
(60, 'photo', 'photo', 'ছবি', 'foto', 'صور', 'foto', 'фото', '照片', 'fotoğraf', 'foto', 'fénykép', 'photo', 'φωτογραφία', 'Foto', 'foto', 'ภาพถ่าย', 'تصویر', 'फ़ोटो', 'Lorem ipsum', 'foto', '写真', '사진'),
(61, 'student_name', 'student name', 'শিক্ষার্থীর নাম', 'Nombre del estudiante', 'اسم الطالب', 'naam van de leerling', 'Имя студента', '学生姓名', 'Öğrenci adı', 'nome do aluno', 'tanuló nevét', 'nom de l''étudiant', 'το όνομα του μαθητή', 'Studentennamen', 'nome dello studente', 'ชื่อนักเรียน', 'طالب علم کے نام', 'छात्र का नाम', 'ipsum est nomen', 'nama siswa', '学生の名前', '학생의 이름'),
(62, 'address', 'address', 'ঠিকানা', 'dirección', 'عنوان', 'adres', 'адрес', '地址', 'adres', 'endereço', 'cím', 'adresse', 'διεύθυνση', 'Adresse', 'indirizzo', 'ที่อยู่', 'ایڈریس', 'पता', 'Oratio', 'alamat', 'アドレス', '주소'),
(63, 'options', 'options', 'অপশন', 'Opciones', 'خيارات', 'opties', 'опции', '选项', 'seçenekleri', 'opções', 'lehetőségek', 'les options', 'Επιλογές', 'Optionen', 'Opzioni', 'ตัวเลือก', 'اختیارات', 'विकल्प', 'options', 'Pilihan', 'オプション', '옵션'),
(64, 'marksheet', 'marksheet', 'marksheet', 'marksheet', 'سجل الدرجات', 'Marksheet', 'marksheet', 'marksheet', 'Marksheet', 'marksheet', 'Marksheet', 'relevé de notes', 'Marksheet', 'marksheet', 'Marksheet', 'marksheet', 'marksheet', 'अंकपत्र', 'marksheet', 'marksheet', 'marksheet', 'marksheet'),
(65, 'id_card', 'id card', 'আইডি কার্ড', 'carnet de identidad', 'الكارنيه المدرسي', 'id-kaart', 'удостоверение личности', '身份证', 'kimlik kartı', 'carteira de identidade', 'személyi igazolvány', 'carte d''identité', 'id κάρτα', 'Ausweis', 'carta d''identità', 'บัตรประชาชน', 'شناختی کارڈ', 'औ डी कार्ड', 'id ipsum', 'id card', 'IDカード', '신분증'),
(66, 'edit', 'edit', 'সম্পাদন করা', 'editar', 'تحرير', 'uitgeven', 'редактировать', '编辑', 'düzenleme', 'editar', 'szerkeszt', 'modifier', 'edit', 'bearbeiten', 'modifica', 'แก้ไข', 'میں ترمیم کریں', 'संपादित करें', 'edit', 'mengedit', '編集', '편집'),
(67, 'delete', 'delete', 'মুছে ফেলা', 'borrar', 'حذف', 'verwijderen', 'удалять', '删除', 'silmek', 'excluir', 'töröl', 'effacer', 'διαγραφή', 'löschen', 'cancellare', 'ลบ', 'خارج', 'हटाना', 'vel deleri,', 'menghapus', '削除する', '삭제'),
(68, 'personal_profile', 'personal profile', 'ব্যক্তিগত প্রোফাইল', 'perfil personal', 'ملف شخصي', 'persoonlijk profiel', 'личный профиль', '个人简介', 'kişisel profil', 'perfil pessoal', 'személyes profil', 'profil personnel', 'προσωπικό προφίλ', 'persönliches Profil', 'profilo personale', 'รายละเอียดข้อมูลส่วนตัว', 'ذاتی پروفائل', 'व्यक्तिगत प्रोफाइल', 'personal profile', 'profil pribadi', '人物点描', '개인 프로필'),
(69, 'academic_result', 'academic result', 'একাডেমিক ফলাফল', 'resultado académico', 'النتيجة الأكاديمية', 'academische resultaat', 'академический результат', '学术成果', 'akademik sonuç', 'resultado acadêmico', 'tudományos eredmény', 'résultat académique', 'ακαδημαϊκή αποτέλεσμα', 'Studienergebnis', 'risultato accademico', 'ผลการศึกษา', 'تعلیمی نتیجہ', 'शैक्षिक परिणाम', 'Ex academicis', 'Hasil akademik', '学術結果', '학습 결​​과'),
(70, 'name', 'name', 'নাম', 'nombre', 'اسم', 'naam', 'название', '名称', 'isim', 'nome', 'név', 'nom', 'όνομα', 'Name', 'nome', 'ชื่อ', 'نام', 'नाम', 'nomen,', 'nama', '名前', '이름'),
(71, 'birthday', 'birthday', 'জন্মদিন', 'cumpleaños', 'تاريخ الميلاد', 'verjaardag', 'день рождения', '生日', 'doğum günü', 'aniversário', 'születésnap', 'anniversaire', 'γενέθλια', 'Geburtstag', 'compleanno', 'วันเกิด', 'سالگرہ', 'जन्मदिन', 'natalis', 'ulang tahun', '誕生日', '생일'),
(72, 'sex', 'sex', 'লিঙ্গ', 'sexo', 'جنس', 'seks', 'секс', '性别', 'seks', 'sexo', 'szex', 'sexe', 'φύλο', 'Sex', 'sesso', 'เพศ', 'جنسی', 'लिंग', 'sex', 'seks', 'セックス', '섹스'),
(73, 'male', 'male', 'পুরুষ', 'masculino', 'ذكر', 'mannelijk', 'мужской', '男性', 'erkek', 'masculino', 'férfi', 'mâle', 'αρσενικός', 'männlich', 'maschio', 'เพศชาย', 'پروفائل', 'नर', 'masculus', 'laki-laki', '男性', '남성'),
(74, 'female', 'female', 'মহিলা', 'femenino', 'أنثى', 'vrouw', 'женский', '女', 'kadın', 'feminino', 'női', 'femelle', 'θηλυκός', 'weiblich', 'femminile', 'เพศหญิง', 'خواتین', 'महिला', 'femina,', 'perempuan', '女性', '여성'),
(75, 'religion', 'religion', 'ধর্ম', 'religión', 'دين', 'religie', 'религия', '宗教', 'din', 'religião', 'vallás', 'religion', 'θρησκεία', 'Religion', 'religione', 'ศาสนา', 'مذہب', 'धर्म', 'religionis,', 'agama', '宗教', '종교'),
(76, 'blood_group', 'blood group', 'রক্তের বিভাগ', 'grupo sanguíneo', 'فصيلة الدم', 'bloedgroep', 'группа крови', '血型', 'kan grubu', 'grupo sanguíneo', 'vércsoport', 'groupe sanguin', 'ομάδα αίματος', 'Blutgruppe', 'gruppo sanguigno', 'กรุ๊ปเลือด', 'خون کے گروپ', 'रक्त वर्ग', 'sanguine coetus', 'golongan darah', '血液型', '혈액형'),
(77, 'phone', 'phone', 'ফোন', 'teléfono', 'هاتف', 'telefoon', 'телефон', '电话', 'telefon', 'telefone', 'telefon', 'téléphone', 'τηλέφωνο', 'Telefon', 'telefono', 'โทรศัพท์', 'فون', 'फ़ोन', 'Praesent', 'telepon', '電話', '전화'),
(78, 'father_name', 'father name', 'পিতার নাম', 'Nombre del padre', 'اسم الأب', 'naam van de vader', 'отчество', '父亲姓名', 'baba adı', 'nome pai', 'apa név', 'nom de père', 'Το όνομα του πατέρα', 'Der Name des Vaters', 'nome del padre', 'ชื่อพ่อ', 'والد کا نام', 'पिता का नाम', 'nomine Patris,', 'Nama ayah', '父親の名前', '아버지의 이름'),
(79, 'mother_name', 'mother name', 'মায়ের নাম', 'Nombre de la madre', 'اسم الأم', 'moeder naam', 'Имя матери', '母亲的名字', 'anne adı', 'Nome mãe', 'anyja név', 'nom de la mère', 'το όνομα της μητέρας', 'Name der Mutter', 'Nome madre', 'ชื่อแม่', 'ماں کا نام', 'माता का नाम', 'matris nomen,', 'Nama ibu', '母の名前', '어머니 이름'),
(80, 'edit_student', 'edit student', 'সম্পাদনা ছাত্র', 'edit estudiante', 'تحرير الطالب', 'bewerk student', 'редактирования студент', '编辑学生', 'edit öğrenci', 'edição aluno', 'szerkesztés diák', 'modifier étudiant', 'επεξεργασία των φοιτητών', 'Schüler bearbeiten', 'modifica dello studente', 'แก้ไขนักเรียน', 'ترمیم کے طالب علم', 'संपादित छात्र', 'edit studiosum', 'mengedit siswa', '編集学生', '편집 학생'),
(81, 'teacher_list', 'teacher list', 'শিক্ষক তালিকা', 'lista maestra', 'قائمة المعلم', 'leraar lijst', 'Список учителей', '老师名单', 'öğretmen listesi', 'lista de professores', 'tanár lista', 'Liste des enseignants', 'Λίστα των εκπαιδευτικών', 'Lehrer-Liste', 'elenco degli insegnanti', 'รายชื่อครู', 'استاد فہرست', 'शिक्षक सूची', 'magister album', 'daftar guru', '教員リスト', '교사의 목록'),
(82, 'add_teacher', 'add teacher', 'শিক্ষক যোগ', 'añadir profesor', 'إضافة المعلم', 'voeg leraar', 'добавить учителя', '加上老师', 'öğretmen ekle', 'adicionar professor', 'hozzá tanár', 'ajouter enseignant', 'προσθέστε δάσκαλος', 'Lehrer hinzufügen', 'aggiungere insegnante', 'เพิ่มครู', 'استاد شامل', 'शिक्षक जोड़', 'Magister addit', 'menambah guru', '先生を追加', '교사를 추가'),
(83, 'teacher_name', 'teacher name', 'শিক্ষক নাম', 'Nombre del profesor', 'اسم المعلم', 'leraarsnaam', 'Имя учителя', '老师姓名', 'öğretmen adı', 'nome professor', 'tanár név', 'nom des enseignants', 'όνομα των εκπαιδευτικών', 'Lehrer Name', 'Nome del docente', 'ชื่อครู', 'استاد کا نام', 'शिक्षक का नाम', 'magister nomine', 'nama guru', '教員名', '교사 이름'),
(84, 'edit_teacher', 'edit teacher', 'সম্পাদনা শিক্ষক', 'edit maestro', 'تحرير المعلم', 'leraar bewerken', 'править учитель', '编辑老师', 'edit öğretmen', 'editar professor', 'szerkesztés tanár', 'modifier enseignant', 'edit εκπαιδευτικών', 'edit Lehrer', 'modifica insegnante', 'แก้ไขครู', 'ترمیم استاد', 'संपादित करें शिक्षक', 'edit magister', 'mengedit guru', '編集の先生', '편집 교사'),
(85, 'manage_parent', 'manage parent', 'অভিভাবক ও পরিচালনা', 'gestionar los padres', 'إدارة أولياء الأمور ', 'beheren ouder', 'управлять родителей', '母公司管理', 'ebeveyn yönetmek', 'gerenciar pai', 'kezelni szülő', 'gérer parent', 'διαχείριση μητρική', 'verwalten Mutter', 'gestione genitore', 'จัดการปกครอง', 'والدین کا انتظام', 'माता - पिता का प्रबंधन', 'curo parent', 'mengelola orang tua', '親を管理', '부모 관리'),
(86, 'parent_list', 'parent list', 'মূল তালিকা', 'lista primaria', 'قائمة الوالد', 'ouder lijst', 'родительского списка', '父列表', 'ebeveyn listesi', 'lista pai', 'szülő lista', 'liste parent', 'μητρική λίστα', 'geordneten Liste', 'elenco padre', 'รายชื่อผู้ปกครอง', 'والدین کی فہرست', 'माता - पिता सूची', 'parente album', 'daftar induk', '親リスト', '상위 목록'),
(87, 'parent_name', 'parent name', 'মূল নাম', 'Nombre del padre', 'اسم الوالد', 'oudernaam', 'родитель название', '父名', 'ebeveyn isim', 'nome do pai', 'szülő név', 'nom du parent', 'μητρικό όνομα', 'Mutternamen', 'nome del padre', 'ชื่อผู้ปกครอง', 'والدین کے نام', 'माता - पिता का नाम', 'Nomen parentis,', 'nama orang tua', '親の名前', '부모 이름'),
(88, 'relation_with_student', 'relation with student', 'ছাত্রদের সঙ্গে সম্পর্ক', 'relación con el estudiante', 'العلاقة مع الطالب', 'relatie met student', 'отношения с учеником', '与学生关系', 'öğrenci ile ilişkisi', 'relação com o aluno', 'kapcsolatban diák', 'relation avec l''élève', 'σχέση με τον μαθητή', 'Zusammenhang mit Studenten', 'rapporto con lo studente', 'ความสัมพันธ์กับนักเรียน', 'طالب علم کے ساتھ تعلق', 'छात्रा के साथ संबंध', 'cum inter ipsum', 'hubungan dengan siswa', '学生との関係', '학생과의 관계'),
(89, 'parent_email', 'parent email', 'মূল ইমেইল', 'correo electrónico de los padres', 'البريد الإلكتروني لولي الأأمر ', 'ouder email', 'родитель письмо', '父母的电子邮件', 'ebeveyn email', 'e-mail dos pais', 'szülő e-mail', 'parent email', 'email του γονέα', 'Eltern per E-Mail', 'email genitore', 'อีเมล์ผู้ปกครอง', 'والدین کا ای میل', 'माता - पिता ईमेल', 'parente email', 'email induk', '親電子メール', '부모의 이메일'),
(90, 'parent_phone', 'parent phone', 'ঊর্ধ্বতন ফোন', 'teléfono de los padres', 'هاتف ولي الامر', 'ouder telefoon', 'родитель телефон', '家长电话', 'ebeveyn telefon', 'telefone dos pais', 'szülő telefon', 'mère de téléphone', 'μητρική τηλέφωνο', 'Elterntelefon', 'telefono genitore', 'โทรศัพท์ของผู้ปกครอง', 'والدین فون', 'माता - पिता को फोन', 'parentis phone', 'telepon orang tua', '親の携帯電話', '부모 전화'),
(91, 'parrent_address', 'parrent address', 'parrent ঠিকানা', 'Dirección Parrent', 'عنوان ولي الأمر', 'parrent adres', 'Parrent адрес', 'parrent地址', 'parrent adresi', 'endereço Parrent', 'parrent cím', 'adresse Parrent', 'parrent διεύθυνση', 'parrent Adresse', 'Indirizzo parrent', 'ที่อยู่ parrent', 'parrent ایڈریس', 'parrent पता', 'oratio parrent', 'alamat parrent', 'parrentアドレス', 'parrent 주소'),
(92, 'parrent_occupation', 'parrent occupation', 'parrent বৃত্তি', 'ocupación Parrent', 'وظيفة ولي الأمر ', 'parrent bezetting', 'Parrent оккупация', 'parrent职业', 'parrent işgal', 'ocupação Parrent', 'parrent Foglalkozás', 'occupation Parrent', 'parrent επάγγελμα', 'parrent Beruf', 'occupazione parrent', 'อาชีพ parrent', 'parrent قبضے', 'parrent कब्जे', 'opus parrent', 'pendudukan parrent', 'parrent職業', 'parrent 직업'),
(93, 'add', 'add', 'যোগ করা', 'añadir', 'إضافة', 'toevoegen', 'добавлять', '加', 'eklemek', 'adicionar', 'hozzáad', 'ajouter', 'προσθήκη', 'hinzufügen', 'aggiungere', 'เพิ่ม', 'شامل', 'जोड़ना', 'Adde', 'menambahkan', '加える', '추가'),
(94, 'parent_of', 'parent of', 'অভিভাবক', 'matriz de', ' ولي الأمر ل', 'ouder van', 'родитель', '父', 'ebeveyn', 'pai', 'szülő', 'parent d''', 'γονέας', 'Muttergesellschaft der', 'madre di', 'ผู้ปกครองของ', 'والدین', 'के माता - पिता', 'parentem,', 'induk dari', 'の親', '의 부모'),
(95, 'profession', 'profession', 'পেশা', 'profesión', 'مهنة', 'beroep', 'профессия', '职业', 'meslek', 'profissão', 'szakma', 'profession', 'επάγγελμα', 'Beruf', 'professione', 'อาชีพ', 'پیشہ', 'व्यवसाय', 'professio', 'profesi', '職業', '직업'),
(96, 'edit_parent', 'edit parent', 'সম্পাদনা ঊর্ধ্বতন', 'edit padres', 'تحرير  ولي الأمر', 'bewerk ouder', 'править родитель', '编辑父', 'edit ebeveyn', 'edição pai', 'szerkesztés szülő', 'modifier parent', 'edit γονέα', 'edit Mutter', 'modifica genitore', 'แก้ไขผู้ปกครอง', 'میں ترمیم کریں والدین', 'संपादित जनक', 'edit parent', 'mengedit induk', '編集親', '편집 부모'),
(97, 'add_parent', 'add parent', 'ঊর্ধ্বতন যোগ', 'añadir los padres', 'إضافة الوالد', 'Voeg een ouder', 'добавить родителя', '添加父', 'ebeveyn ekle', 'adicionar pai', 'hozzá szülő', 'ajouter parent', 'προσθέστε μητρική', 'Mutter hinzufügen', 'aggiungere genitore', 'เพิ่มผู้ปกครอง', 'والدین شامل', 'माता - पिता जोड़', 'adde parent', 'menambahkan orang tua', '親を追加', '부모를 추가'),
(98, 'manage_subject', 'manage subject', 'বিষয় ও পরিচালনা', 'gestionar sujeto', 'إدارة الموضوع', 'beheren onderwerp', 'управлять тему', '管理主题', 'konuyu yönetmek', 'gerenciar assunto', 'kezelni tárgy', 'gérer sujet', 'διαχείριση υπόκειται', 'Thema verwalten', 'gestire i soggetti', 'การจัดการเรื่อง', 'موضوع کا انتظام', 'विषय का प्रबंधन', 'subiectum disponat', 'mengelola subjek', '対象を管理', '대상 관리'),
(99, 'subject_list', 'subject list', 'বিষয় তালিকা', 'lista por materia', 'قائمة الموضوع', 'Onderwerp lijst', 'Список подлежит', '主题列表', 'konu listesi', 'lista por assunto', 'téma lista', 'liste de sujets', 'υπόκεινται λίστα', 'Themenliste', 'lista soggetto', 'รายการเรื่อง', 'موضوع کی فہرست', 'विषय सूची', 'subiectum album', 'daftar subjek', 'サブジェクトリスト', '주제 목록'),
(100, 'add_subject', 'add subject', 'বিষয় যোগ', 'Añadir asunto', 'إضافة الموضوع', 'Onderwerp toevoegen', 'добавить тему', '新增主题', 'konu ekle', 'adicionar assunto', 'Tárgy hozzáadása', 'ajouter l''objet', 'Προσθήκη θέματος', 'Thema hinzufügen', 'aggiungere soggetto', 'เพิ่มเรื่อง', 'موضوع', 'जोड़ें विषय', 're addere', 'menambahkan subjek', '件名を追加', '제목을 추가'),
(101, 'subject_name', 'subject name', 'বিষয় নাম', 'nombre del sujeto', 'اسم الموضوع', 'Onderwerp naam', 'имя субъекта', '主题名称', 'konu adı', 'nome do assunto', 'tárgy megnevezése', 'nom du sujet', 'υπόκεινται όνομα', 'Thema Namen', 'nome del soggetto', 'ชื่อเรื่อง', 'موضوع کے نام', 'विषय का नाम', 'agitur nomine', 'nama subjek', 'サブジェクト名', '주체 이름'),
(102, 'edit_subject', 'edit subject', 'সম্পাদনা বিষয়', 'Editar asunto', 'تحرير الموضوع', 'Onderwerp bewerken', 'Изменить тему', '编辑主题', 'düzenleme konusu', 'Editar assunto', 'Tárgy szerkesztése', 'modifier l''objet', 'edit θέμα', 'Betreff bearbeiten', 'Modifica oggetto', 'แก้ไขเรื่อง', 'موضوع میں ترمیم کریں', 'विषय संपादित करें', 'edit subiecto', 'mengedit subjek', '編集対象', '제목 수정'),
(103, 'manage_class', 'manage class', 'ক্লাস ও পরিচালনা', 'gestionar clase', 'إدارة الفصل', 'beheren klasse', 'управлять класс', '管理类', 'sınıf yönetmek', 'gerenciar classe', 'kezelni osztály', 'gérer classe', 'διαχείριση τάξης', 'Klasse verwalten', 'gestione della classe', 'การจัดการชั้นเรียน', 'کلاس کا انتظام', 'वर्ग का प्रबंधन', 'genus regendi', 'mengelola kelas', 'クラスを管理', '클래스에게 관리'),
(104, 'class_list', 'class list', 'বর্গ তালিকা', 'lista de la clase', 'قائمة الفصول', 'klasse lijst', 'Список класс', '类列表', 'sınıf listesi', 'lista de classe', 'class lista', 'liste de classe', 'πίνακας αποτελεσμάτων', 'Klassenliste', 'elenco di classe', 'รายการชั้น', 'کلاس فہرست', 'कक्षा सूची', 'genus album', 'daftar kelas', 'クラスリスト', '클래스 목록'),
(105, 'add_class', 'add class', 'ক্লাসে যোগ', 'agregar la clase', 'إضافة فصل ', 'voeg klasse', 'добавить класс', '添加类', 'sınıf eklemek', 'adicionar classe', 'hozzá osztály', 'ajouter la classe', 'προσθέσετε τάξη', 'Klasse hinzufügen', 'aggiungere classe', 'เพิ่มระดับ', 'کلاس شامل کریں', 'वर्ग जोड़', 'adde genus', 'menambahkan kelas', 'クラスを追加', '클래스를 추가'),
(106, 'class_name', 'class name', 'শ্রেণীর নাম', 'nombre de la clase', 'اسم الفصل ', 'class naam', 'Имя класса', '类名', 'sınıf adı', 'nome da classe', 'osztály neve', 'nom de la classe', 'όνομα της κλάσης', 'Klassennamen', 'nome della classe', 'ชื่อชั้น', 'کلاس نام', 'वर्ग के नाम', 'Classis nomine', 'nama kelas', 'クラス名', '클래스 이름'),
(107, 'numeric_name', 'numeric name', 'সাংখ্যিক নাম', 'nombre numérico', 'اسم رقمية', 'numerieke naam', 'числовое имя', '数字名称', 'Sayısal isim', 'nome numérico', 'numerikus név', 'nom numérique', 'αριθμητικό όνομα', 'numerischen Namen', 'nome numerico', 'ชื่อตัวเลข', 'عددی نام', 'सांख्यिक नाम', 'secundum numerum est secundum nomen,', 'Nama numerik', '数値の名前', '숫자 이름');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(108, 'name_numeric', 'name numeric', 'সাংখ্যিক নাম দিন', 'nombre numérico', 'تسمية رقمية', 'naam numerieke', 'назвать числовой', '数字命名', 'sayısal isim', 'nome numérico', 'név numerikus', 'nommer numérique', 'όνομα αριθμητικό', 'nennen numerischen', 'nome numerico', 'ชื่อตัวเลข', 'عددی نام', 'सांख्यिक का नाम', 'secundum numerum est secundum nomen,', 'nama numerik', '数値に名前を付ける', '숫자 이름을'),
(109, 'edit_class', 'edit class', 'সম্পাদনা বর্গ', 'clase de edición', 'الطبقة تحرير', 'bewerken klasse', 'править класс', '编辑类', 'sınıf düzenle', 'edição classe', 'szerkesztés osztály', 'modifier la classe', 'edit κατηγορία', 'Klasse bearbeiten', 'modifica della classe', 'แก้ไขระดับ', 'ترمیم کلاس', 'संपादित वर्ग', 'edit genere', 'mengedit kelas', '編集クラス', '편집 클래스'),
(110, 'manage_exam', 'manage exam', 'পরীক্ষা পরিচালনা', 'gestionar examen', 'إدارة الامتحان', 'beheren examen', 'управлять экзамен', '考试管理', 'sınavı yönetmek', 'gerenciar exame', 'kezelni vizsga', 'gérer examen', 'διαχείριση εξετάσεις', 'Prüfung verwalten', 'gestire esame', 'การจัดการสอบ', 'امتحان کا انتظام', 'परीक्षा का प्रबंधन', 'curo ipsum', 'mengelola ujian', '試験を管理', '시험 관리'),
(111, 'exam_list', 'exam list', 'পরীক্ষার তালিকা', 'lista de exámenes', 'قائمة الامتحان', 'examen lijst', 'Список экзамен', '考试名单', 'sınav listesi', 'lista de exames', 'vizsga lista', 'liste d''examen', 'Λίστα εξετάσεις', 'Prüfungsliste', 'elenco esami', 'รายการสอบ', 'امتحان فہرست', 'परीक्षा सूची', 'Lorem ipsum album', 'daftar ujian', '試験のリスト', '시험 목록'),
(112, 'add_exam', 'add exam', 'পরীক্ষার যোগ', 'agregar examen', 'إضافة امتحان', 'voeg examen', 'добавить экзамен', '新增考试', 'sınav eklemek', 'adicionar exame', 'hozzá vizsga', 'ajouter examen', 'προσθέσετε εξετάσεις', 'Prüfung hinzufügen', 'aggiungere esame', 'เพิ่มการสอบ', 'امتحان میں شامل کریں', 'परीक्षा जोड़', 'adde ipsum', 'menambahkan ujian', '試験を追加', '시험에 추가'),
(113, 'exam_name', 'exam name', 'পরীক্ষার নাম', 'nombre del examen', 'اسم الامتحان', 'examen naam', 'Название экзамен', '考试名称', 'sınav adı', 'nome do exame', 'Vizsga neve', 'nom de l''examen', 'Το όνομά εξετάσεις', 'Prüfungsnamen', 'nome dell''esame', 'ชื่อสอบ', 'امتحان کے نام', 'परीक्षा का नाम', 'ipsum nomen,', 'Nama ujian', '試験名', '시험 이름'),
(114, 'date', 'date', 'তারিখ', 'fecha', 'تاريخ', 'datum', 'дата', '日期', 'tarih', 'data', 'dátum', 'date', 'ημερομηνία', 'Datum', 'data', 'วันที่', 'تاریخ', 'तारीख', 'date', 'tanggal', '日付', '날짜'),
(115, 'comment', 'comment', 'মন্তব্য', 'comentario', 'تعليق', 'commentaar', 'комментарий', '评论', 'yorum', 'comentário', 'megjegyzés', 'commentaire', 'σχόλιο', 'Kommentar', 'commento', 'ความเห็น', 'تبصرہ', 'टिप्पणी', 'comment', 'komentar', 'コメント', '논평'),
(116, 'edit_exam', 'edit exam', 'সম্পাদনা পরীক্ষা', 'examen de edición', 'امتحان تحرير', 'bewerk examen', 'править экзамен', '编辑考试', 'edit sınavı', 'edição do exame', 'szerkesztés vizsga', 'modifier examen', 'edit εξετάσεις', 'edit Prüfung', 'modifica esame', 'แก้ไขการสอบ', 'ترمیم امتحان', 'संपादित परीक्षा', 'edit ipsum', 'mengedit ujian', '編集試験', '편집 시험'),
(117, 'manage_exam_marks', 'manage exam marks', 'পরীক্ষা চিহ্ন ও পরিচালনা', 'gestionar marcas de examen', 'إدارة علامات الامتحان', 'beheren examencijfers', 'управлять экзаменационные отметки', '管理考试痕', 'sınav işaretleri yönetmek', 'gerenciar marcas exame', 'kezelni vizsga jelek', 'gérer les marques d''examen', 'διαχείριση των σημάτων εξετάσεις', 'Prüfungsnoten verwalten', 'gestire i voti degli esami', 'จัดการสอบเครื่องหมาย', 'امتحان کے نشانات کا انتظام', 'परीक्षा के निशान का प्रबंधन', 'ipsum curo indicia', 'mengelola nilai ujian', '試験マークを管理', '시험 점수를 관리'),
(118, 'manage_marks', 'manage marks', 'চিহ্ন ও পরিচালনা', 'gestionar marcas', 'إدارة علامات', 'beheren merken', 'управлять знаки', '商标管理', 'işaretleri yönetmek', 'gerenciar marcas', 'kezelni jelek', 'gérer les marques', 'διαχείριση των σημάτων', 'Markierungen verwalten', 'gestire i marchi', 'จัดการเครื่องหมาย', 'نمبروں کا انتظام', 'निशान का प्रबंधन', 'curo indicia', 'mengelola tanda', 'マークを管理', '마크를 관리'),
(119, 'select_exam', 'select exam', 'পরীক্ষার নির্বাচন', 'seleccione examen', 'حدد الامتحان', 'selecteer examen', 'выбрать экзамен', '选择考试', 'sınavı seçin', 'selecionar exame', 'válassza ki a vizsga', 'sélectionnez examen', 'επιλέξτε εξετάσεις', 'Prüfung wählen', 'seleziona esame', 'เลือกสอบ', 'امتحان منتخب کریں', 'परीक्षा का चयन', 'velit ipsum', 'pilih ujian', '受験を選択', '시험을 선택'),
(120, 'select_class', 'select class', 'বর্গ নির্বাচন', 'seleccione clase', 'حدد الفصل', 'selecteren klasse', 'выбрать класс', '选择产品类别', 'sınıf seçin', 'selecionar classe', 'válassza osztály', 'sélectionnez classe', 'Επιλέξτε κατηγορία', 'Klasse wählen', 'seleziona classe', 'เลือกชั้น', 'کلاس منتخب کریں', 'वर्ग का चयन करें', 'genus eligere,', 'pilih kelas', 'クラスを選択', '클래스를 선택'),
(121, 'select_subject', 'select subject', 'বিষয় নির্বাচন করুন', 'seleccione tema', 'حدد الموضوع', 'Selecteer onderwerp', 'выберите тему', '选择主题', 'konu seçin', 'selecionar assunto', 'Válassza a Tárgy', 'sélectionner le sujet', 'επιλέξτε θέμα', 'Thema wählen', 'seleziona argomento', 'เลือกเรื่อง', 'موضوع منتخب کریں', 'विषय का चयन', 'eligere subditos', 'pilih subjek', '件名を選択', '주제를 선택'),
(122, 'select_an_exam', 'select an exam', 'একটি পরীক্ষা নির্বাচন', 'seleccione un examen', 'حدد الامتحان', 'selecteer een examen', 'выбрать экзамен', '选择考试', 'Bir sınav seçin', 'selecionar um exame', 'válasszon ki egy vizsga', 'sélectionner un examen', 'επιλέξτε μια εξέταση', 'Wählen Sie eine Prüfung', 'selezionare un esame', 'เลือกสอบ', 'امتحان منتخب کریں', 'एक परीक्षा का चयन', 'Eligebatur autem ipsum', 'pilih ujian', '受験を選択', '시험을 선택'),
(123, 'mark_obtained', 'mark obtained', 'চিহ্নিত প্রাপ্ত', 'calificación obtenida', 'بمناسبة الحصول على', 'markeren verkregen', 'отметить получены', '获得标', 'işaretlemek elde', 'marca obtida', 'jelölje kapott', 'marquer obtenu', 'σήμα που λαμβάνεται', 'Markieren Sie erhalten', 'contrassegnare ottenuto', 'ทำเครื่องหมายที่ได้รับ', 'نشان زد حاصل', 'अंक प्राप्त', 'attende obtinuit', 'menandai diperoleh', 'マークが得', '마크 획득'),
(124, 'attendance', 'attendance', 'উপস্থিতি', 'asistencia', 'الحضور', 'opkomst', 'посещаемость', '护理', 'katılım', 'comparecimento', 'részvétel', 'présence', 'παρουσία', 'Teilnahme', 'partecipazione', 'การดูแลรักษา', 'حاضری', 'उपस्थिति', 'auscultant', 'kehadiran', '出席', '출석'),
(125, 'manage_grade', 'manage grade', 'গ্রেড পরিচালনা', 'gestión de calidad', 'إدارة الصفوف', 'beheren leerjaar', 'управлять класс', '管理级', 'notu yönetmek', 'gerenciar grau', 'kezelni fokozat', 'gérer de qualité', 'διαχείριση ποιότητας', 'Klasse verwalten', 'gestione grade', 'จัดการเกรด', 'گریڈ کا انتظام', 'ग्रेड का प्रबंधन', 'moderari gradu', 'mengelola kelas', 'グレードを管理', '등급 관리'),
(126, 'grade_list', 'grade list', 'গ্রেড তালিকা', 'Lista de grado', 'قائمة الصفوف', 'cijferlijst', 'Список класса', '等级列表', 'sınıf listesi', 'lista grau', 'fokozat lista', 'liste de qualité', 'Λίστα βαθμού', 'Notenliste', 'elenco grade', 'รายการเกรด', 'گریڈ فہرست', 'ग्रेड की सूची', 'gradus album', 'daftar kelas', 'グレード一覧', '등급 목록'),
(127, 'add_grade', 'add grade', 'গ্রেড যোগ করুন', 'añadir grado', 'إضافة الصف', 'voeg leerjaar', 'добавить класс', '添加级', 'not eklemek', 'adicionar grau', 'hozzá fokozat', 'ajouter note', 'προσθήκη βαθμού', 'Klasse hinzufügen', 'aggiungere grade', 'เพิ่มเกรด', 'گریڈ میں شامل کریں', 'ग्रेड जोड़', 'adde gradum,', 'menambahkan kelas', 'グレードを追加', '등급을 추가'),
(128, 'grade_name', 'grade name', 'গ্রেড নাম', 'Nombre de grado', 'اسم الصف', 'rangnaam', 'Название сорта', '等级名称', 'sınıf adı', 'nome da classe', 'fokozat név', 'nom de la catégorie', 'Όνομα βαθμού', 'Klasse Name', 'nome del grado', 'ชื่อชั้น', 'گریڈ نام', 'ग्रेड का नाम', 'nomen, gradus,', 'nama kelas', 'グレード名', '등급 이름'),
(129, 'grade_point', 'grade point', 'গ্রেড পয়েন্ট', 'de calificaciones', 'درجة الصف', 'rangpunt', 'балл', '成绩', 'not', 'ponto de classe', 'fokozatú pont', 'cumulative', 'βαθμών', 'Noten', 'punto di grado', 'จุดเกรด', 'گریڈ پوائنٹ', 'ग्रेड बिंदु', 'gradus punctum', 'indeks prestasi', '成績評価点', '학점'),
(130, 'mark_from', 'mark from', 'চিহ্ন থেকে', 'marca de', 'علامة من', 'mark uit', 'знак от', '从商标', 'mark dan', 'marca de', 'jelölést', 'marque de', 'σήμα από', 'Marke aus', 'segno da', 'เครื่องหมายจาก', 'نشان سے', 'मार्क से', 'marcam', 'mark dari', 'マークから', '표에서'),
(131, 'mark_upto', 'mark upto', 'পর্যন্ত চিহ্নিত', 'marcar hasta', 'بمناسبة تصل', 'mark tot', 'отметить ДО', '高达标记', 'kadar işaretlemek', 'marcar até', 'jelölje upto', 'marquer jusqu''à', 'σήμα μέχρι', 'Markieren Sie bis zu', 'contrassegnare fino a', 'ทำเครื่องหมายเกิน', 'تک کے موقع', 'तक चिह्नित', 'Genitus est notare', 'menandai upto', '点で最大マーク', '표까지'),
(132, 'edit_grade', 'edit grade', 'সম্পাদনা গ্রেড', 'edit grado', 'تحرير الصف', 'Cijfer bewerken', 'править класса', '编辑等级', 'edit notu', 'edição grau', 'szerkesztés fokozat', 'edit qualité', 'edit βαθμού', 'edit Grad', 'modifica grade', 'แก้ไขเกรด', 'ترمیم گریڈ', 'संपादित ग्रेड', 'edit gradu', 'mengedit kelas', '編集グレード', '편집 등급'),
(133, 'manage_class_routine', 'manage class routine', 'ক্লাসের রুটিন পরিচালনা', 'gestionar rutina de la clase', 'إدارة الجدول الكدرسي', 'beheren klasroutine', 'управлять рутину класса', '管理类常规', 'sınıf rutin yönetmek', 'gerenciar rotina classe', 'kezelni class rutin', 'gérer la routine de classe', 'διαχειρίζονται τάξη ρουτίνα', 'verwalten Klasse Routine', 'gestione classe di routine', 'การจัดการชั้นเรียนตามปกติ', 'کلاس معمول کا انتظام', 'वर्ग दिनचर्या का प्रबंधन', 'uno in genere tractare', 'mengelola rutinitas kelas', 'クラスルーチンを管理', '수준의 일상적인 관리'),
(134, 'class_routine_list', 'class routine list', 'ক্লাসের রুটিন তালিকা', 'clase de lista de rutina', 'قائمة جدوال الفصول', 'klasroutine lijst', 'класс рутина список', '班级常规列表', 'sınıf rutin listesi', 'classe de lista de rotina', 'osztály rutin lista', 'classe liste routine', 'κλάση list ρουτίνας', 'Klasse Routine Liste', 'classe lista di routine', 'รายการประจำชั้น', 'کلاس معمول کے مطابق فہرست', 'वर्ग दिनचर्या सूची', 'uno genere album', 'Daftar rutin kelas', 'クラスルーチン一覧', '클래스 루틴 목록'),
(135, 'add_class_routine', 'add class routine', 'ক্লাসের রুটিন যুক্ত', 'añadir rutina de la clase', 'إضافة جدول القصل ', 'voeg klasroutine', 'добавить подпрограмму класса', '添加类常规', 'sınıf rutin eklemek', 'adicionar rotina classe', 'hozzá class rutin', 'ajouter routine de classe', 'προσθέσετε τάξη ρουτίνα', 'Klasse hinzufügen Routine', 'aggiungere classe di routine', 'เพิ่มระดับตามปกติ', 'کلاس معمول میں شامل کریں', 'वर्ग दिनचर्या जोड़', 'adde genus moris', 'menambahkan rutin kelas', 'クラス·ルーチンを追加', '클래스 루틴을 추가'),
(136, 'day', 'day', 'দিন', 'día', 'يوم', 'dag', 'день', '日', 'gün', 'dia', 'nap', 'jour', 'ημέρα', 'Tag', 'giorno', 'วัน', 'دن', 'दिन', 'die,', 'hari', '日', '일'),
(137, 'starting_time', 'starting time', 'সময়ের শুরু', 'tiempo de inicio', 'بدءا الوقت', 'starttijd', 'время начала', '开始时间', 'başlangıç ​​zamanı', 'tempo começando', 'indítási idő', 'temps de démarrage', 'ώρα έναρξης', 'Startzeit', 'tempo di avviamento', 'เวลาเริ่มต้น', 'وقت شروع ہونے', 'समय की शुरुआत के', 'tum satus', 'waktu mulai', '起動時間', '시작 시간'),
(138, 'ending_time', 'ending time', 'সময় শেষ', 'hora de finalización', 'تنتهي الساعة', 'eindtijd', 'время окончания', '结束时间', 'bitiş zamanını', 'tempo final', 'befejezési időpont', 'heure de fin', 'ώρα λήξης', 'Endzeit', 'ora finale', 'สิ้นสุดเวลา', 'وقت ختم', 'समय समाप्त होने के', 'et finis temporis,', 'akhir waktu', '終了時刻', '종료 시간'),
(139, 'edit_class_routine', 'edit class routine', 'সম্পাদনা ক্লাস রুটিন', 'rutina de la clase de edición', 'تعديل الجدول المدرسي', 'bewerk klasroutine', 'Процедура редактирования класс', '编辑类常规', 'sınıf düzenle rutin', 'rotina de edição de classe', 'szerkesztés osztály rutin', 'routine modifier de classe', 'edit τάξη ρουτίνα', 'edit Klasse Routine', 'modifica della classe di routine', 'แก้ไขชั้นเรียนตามปกติ', 'ترمیم کلاس معمول', 'संपादित वर्ग दिनचर्या', 'edit uno genere', 'rutin mengedit kelas', '編集クラスのルーチン', '편집 클래스 루틴'),
(140, 'manage_invoice/payment', 'manage invoice/payment', 'চালান / পেমেন্ট পরিচালনা', 'gestionar factura / pago', 'إدارة فاتورة / دفع', 'beheren factuur / betaling', 'управлять счета / оплата', '管理发票/付款', 'fatura / ödeme yönetmek', 'gerenciar fatura / pagamento', 'kezelni számla / fizetési', 'gérer facture / paiement', 'διαχείριση τιμολογίου / πληρωμής', 'Verwaltung Rechnung / Zahlung', 'gestione fattura / pagamento', 'จัดการใบแจ้งหนี้ / การชำระเงิน', 'انوائس / ادائیگی کا انتظام', 'चालान / भुगतान का प्रबंधन', 'curo cautionem / solutionem', 'mengelola tagihan / pembayaran', '請求書/支払管理', '인보이스 / 결제 관리'),
(141, 'invoice/payment_list', 'invoice/payment list', 'চালান / পেমেন্ট তালিকা', 'lista de facturas / pagos', 'قائمة فاتورة / دفع', 'factuur / betaling lijst', 'Список счета / оплата', '发票/付款清单', 'fatura / ödeme listesi', 'lista de fatura / pagamento', 'számla / fizetési lista', 'liste facture / paiement', 'Λίστα τιμολογίου / πληρωμής', 'Rechnung / Zahlungsliste', 'elenco fattura / pagamento', 'รายการใบแจ้งหนี้ / การชำระเงิน', 'انوائس / ادائیگی کی فہرست', 'चालान / भुगतान सूची', 'cautionem / list pretium', 'daftar tagihan / pembayaran', '請求書/支払一覧', '인보이스 / 결제리스트'),
(142, 'add_invoice/payment', 'add invoice/payment', 'চালান / পেমেন্ট যোগ', 'añadir factura / pago', 'إضافة فاتورة / دفع', 'voeg factuur / betaling', 'добавить счета / оплата', '添加发票/付款', 'fatura / ödeme eklemek', 'adicionar factura / pagamento', 'hozzá számla / fizetési', 'ajouter facture / paiement', 'προσθήκη τιμολογίου / πληρωμής', 'hinzufügen Rechnung / Zahlung', 'aggiungere fatturazione / pagamento', 'เพิ่มใบแจ้งหนี้ / การชำระเงิน', 'انوائس / ادائیگی شامل', 'चालान / भुगतान जोड़ें', 'add cautionem / solutionem', 'menambahkan tagihan / pembayaran', '請求書/支払を追加', '송장 / 지불을 추가'),
(143, 'title', 'title', 'খেতাব', 'título', 'لقب', 'titel', 'название', '标题', 'başlık', 'título', 'cím', 'titre', 'τίτλος', 'Titel', 'titolo', 'ชื่อเรื่อง', 'عنوان', 'शीर्षक', 'title', 'judul', 'タイトル', '표제'),
(144, 'description', 'description', 'বিবরণ', 'descripción', 'وصف', 'beschrijving', 'описание', '描述', 'tanım', 'descrição', 'leírás', 'description', 'περιγραφή', 'Beschreibung', 'descrizione', 'ลักษณะ', 'تفصیل', 'विवरण', 'description', 'deskripsi', '説明', '기술'),
(145, 'amount', 'amount', 'পরিমাণ', 'cantidad', 'مبلغ', 'bedrag', 'количество', '量', 'miktar', 'quantidade', 'mennyiség', 'montant', 'ποσό', 'Menge', 'importo', 'จำนวน', 'رقم', 'राशि', 'tantum', 'jumlah', '額', '양'),
(146, 'status', 'status', 'অবস্থা', 'estado', 'حالة', 'toestand', 'статус', '状态', 'durum', 'estado', 'állapot', 'statut', 'κατάσταση', 'Status', 'stato', 'สถานะ', 'درجہ', 'हैसियत', 'status', 'status', 'ステータス', '지위'),
(147, 'view_invoice', 'view invoice', 'দেখুন চালান', 'vista de la factura', 'عرض الفاتورة', 'view factuur', 'вид счета-фактуры', '查看发票', 'view fatura', 'vista da fatura', 'view számla', 'vue facture', 'προβολή τιμολόγιο', 'Ansicht Rechnung', 'vista fattura', 'ดูใบแจ้งหนี้', 'دیکھیں انوائس', 'देखें चालान', 'propter cautionem', 'lihat faktur', 'ビュー請求書', '보기 송장'),
(148, 'paid', 'paid', 'পরিশোধ', 'pagado', 'مدفوع', 'betaald', 'оплаченный', '支付', 'ücretli', 'pago', 'fizetett', 'payé', 'καταβληθεί', 'bezahlt', 'pagato', 'ต้องจ่าย', 'ادا کیا', 'प्रदत्त', 'solutis', 'dibayar', '支払われた', '지급'),
(149, 'unpaid', 'unpaid', 'অবৈতনিক', 'no pagado', 'غير مدفوع', 'onbetaald', 'неоплаченный', '未付', 'ödenmemiş', 'não remunerado', 'kifizetetlen', 'non rémunéré', 'απλήρωτη', 'unbezahlt', 'non pagato', 'ยังไม่ได้ชำระ', 'بلا معاوضہ', 'अवैतनिक', 'non est constitutus,', 'dibayar', '未払い', '지불하지 않은'),
(150, 'add_invoice', 'add invoice', 'চালান যোগ', 'añadir factura', 'إضافة الفاتورة', 'voeg factuur', 'добавить счет', '添加发票', 'faturayı eklemek', 'adicionar fatura', 'hozzá számla', 'ajouter facture', 'προσθέστε τιμολόγιο', 'Rechnung hinzufügen', 'aggiungere fattura', 'เพิ่มใบแจ้งหนี้', 'انوائس میں شامل', 'चालान जोड़', 'add cautionem', 'menambahkan faktur', '請求書を追加', '송장을 추가'),
(151, 'payment_to', 'payment to', 'পেমেন্ট', 'pago a', 'دفع ل', 'betaling aan', 'оплата', '支付', 'için ödeme', 'pagamento', 'fizetés', 'paiement', 'πληρωμή', 'Zahlung an', 'pagamento', 'ชำระเงินให้กับ', 'ادائیگی', 'को भुगतान', 'pecunia', 'pembayaran kepada', 'への支払い', '에 지불'),
(152, 'bill_to', 'bill to', 'বিল', 'proyecto de ley para', 'تم الدفع ل ', 'wetsvoorstel om', 'Законопроект о', '法案', 'bill', 'projeto de lei para', 'törvényjavaslat', 'projet de loi', 'νομοσχέδιο για την', 'Gesetzentwurf zur', 'disegno di legge per', 'บิล', 'بل', 'बिल के लिए', 'latumque', 'RUU untuk', '請求する', '법안'),
(153, 'invoice_title', 'invoice title', 'চালান শিরোনাম', 'Título de la factura', 'عنوان الفاتورة', 'factuur titel', 'Название счета', '发票抬头', 'fatura başlık', 'título fatura', 'számla cím', 'titre de la facture', 'Τίτλος τιμολόγιο', 'Rechnungs Titel', 'title fattura', 'ชื่อใบแจ้งหนี้', 'انوائس عنوان', 'चालान शीर्षक', 'title cautionem', 'judul faktur', '請求書のタイトル', '송장 제목'),
(154, 'invoice_id', 'invoice id', 'চালান আইডি', 'Identificación de la factura', 'رقم الفاتورة ', 'factuur id', 'счет-фактура ID', '发票编号', 'fatura id', 'id fatura', 'számla id', 'Identifiant facture', 'id τιμολόγιο', 'Rechnung-ID', 'fattura id', 'ใบแจ้งหนี้หมายเลข', 'انوائس ID', 'चालान आईडी', 'id cautionem', 'faktur id', '請求書ID', '송장 ID'),
(155, 'edit_invoice', 'edit invoice', 'সম্পাদনা চালান', 'edit factura', 'تحرير الفاتورة', 'bewerk factuur', 'редактирования счета-фактуры', '编辑发票', 'edit fatura', 'edição fatura', 'szerkesztés számla', 'modifier la facture', 'edit τιμολόγιο', 'edit Rechnung', 'modifica fattura', 'แก้ไขใบแจ้งหนี้', 'ترمیم انوائس', 'संपादित चालान', 'edit cautionem', 'mengedit faktur', '編集送り状', '편집 송장'),
(156, 'manage_library_books', 'manage library books', 'লাইব্রেরির বই ও পরিচালনা', 'gestionar libros de la biblioteca', 'إدارة مكتبة الكتب', 'beheren bibliotheekboeken', 'управлять библиотечные книги', '管理图书', 'kitapları kütüphane yönetmek', 'gerenciar os livros da biblioteca', 'kezelni könyvtári könyvek', 'gérer des livres de bibliothèque', 'διαχειριστείτε τα βιβλία της βιβλιοθήκης', 'Bücher aus der Bibliothek verwalten', 'gestire i libri della biblioteca', 'จัดการหนั​​งสือห้องสมุด', 'کتب خانے کی کتابیں منظم', 'पुस्तकालय की पुस्तकों का प्रबंधन', 'curo bibliotheca librorum,', 'mengelola buku perpustakaan', '図書館の本を管理', '도서관 책 관리'),
(157, 'book_list', 'book list', 'পাঠ্যতালিকা', 'lista de libros', 'قائمة الكتب', 'boekenlijst', 'Список книг', '书单', 'kitap listesi', 'lista de livros', 'book lista', 'liste de livres', 'λίστα βιβλίων', 'Buchliste', 'elenco libri', 'รายการหนั​​งสือ', 'کتاب کی فہرست', 'पुस्तक सूची', 'album', 'daftar buku', 'ブックリスト', '도서 목록'),
(158, 'add_book', 'add book', 'বই যোগ', 'Añadir libro', 'إضافة كتاب', 'boek toevoegen', 'добавить книгу', '加入书', 'kitap eklemek', 'adicionar livro', 'Könyv hozzáadása', 'ajouter livre', 'προσθέστε το βιβλίο', 'Buch hinzufügen', 'aggiungere il libro', 'เพิ่มหนังสือ', 'کتاب شامل', 'पुस्तक जोड़', 'adde libri', 'menambahkan buku', '本を追加', '책을 추가'),
(159, 'book_name', 'book name', 'বইয়ের নাম', 'Nombre del libro', 'اسم الكتاب', 'boeknaam', 'Название книги', '书名', 'kitap adı', 'nome livro', 'book név', 'nom de livre', 'το όνομα του βιβλίου', 'Buchnamen', 'nome del libro', 'ชื่อหนังสือ', 'کتاب کا نام', 'किताब का नाम', 'librum nomine', 'nama buku', 'ブック名', '책 이름'),
(160, 'author', 'author', 'লেখক', 'autor', 'الكاتب', 'auteur', 'автор', '作者', 'yazar', 'autor', 'szerző', 'auteur', 'συγγραφέας', 'Autor', 'autore', 'ผู้เขียน', 'مصنف', 'लेखक', 'auctor', 'penulis', '著者', '저자'),
(161, 'price', 'price', 'দাম', 'precio', 'السعر', 'prijs', 'цена', '价格', 'fiyat', 'preço', 'ár', 'prix', 'τιμή', 'Preis', 'prezzo', 'ราคา', 'قیمت', 'कीमत', 'price', 'harga', '価格', '가격'),
(162, 'available', 'available', 'উপলব্ধ', 'disponible', 'متاح', 'beschikbaar', 'доступный', '可用的', 'mevcut', 'disponível', 'rendelkezésre álló', 'disponible', 'διαθέσιμος', 'verfügbar', 'disponibile', 'สามารถใช้ได้', 'دستیاب', 'उपलब्ध', 'available', 'tersedia', '利用できる', '유효한'),
(163, 'unavailable', 'unavailable', 'অপ্রাপ্য', 'indisponible', 'غير متاح', 'niet beschikbaar', 'недоступен', '不可用', 'yok', 'indisponível', 'érhető el', 'indisponible', 'διαθέσιμο', 'nicht verfügbar', 'non disponibile', 'ไม่มี', 'دستیاب نہیں', 'अनुपलब्ध', 'unavailable', 'tidak tersedia', '利用できない', '없는'),
(164, 'edit_book', 'edit book', 'সম্পাদনা বই', 'libro de edición', 'كتاب تحرير', 'bewerk boek', 'править книга', '编辑本书', 'edit kitap', 'edição do livro', 'edit könyv', 'edit livre', 'επεξεργαστείτε το βιβλίο', 'edit Buch', 'modifica book', 'แก้ไขหนังสือ', 'ترمیم کتاب', 'संपादित पुस्तक', 'edit Liber', 'mengedit buku', '編集の本', '편집 책'),
(165, 'manage_transport', 'manage transport', 'পরিবহন ও পরিচালনা', 'gestionar el transporte', 'إدارة النقل', 'beheren van vervoerssystemen', 'управлять транспортом', '运输管理', 'ulaşım yönetmek', 'gerenciar o transporte', 'kezelni a közlekedés', 'la gestion du transport', 'διαχείριση των μεταφορών', 'Transport verwalten', 'gestire i trasporti', 'การจัดการการขนส่ง', 'نقل و حمل کے انتظام', 'परिवहन का प्रबंधन', 'curo onerariis', 'mengelola transportasi', '輸送を管理', '교통 관리'),
(166, 'transport_list', 'transport list', 'পরিবহন তালিকা', 'Lista de transportes', 'قائمة النقل', 'lijst vervoer', 'лист транспорт', '运输名单', 'taşıma listesi', 'Lista de transportes', 'szállítás lista', 'liste de transport', 'Λίστα των μεταφορών', 'Transportliste', 'elenco trasporti', 'รายการการขนส่ง', 'نقل و حمل کی فہرست', 'परिवहन सूची', 'turpis album', 'daftar transport', '輸送一覧', '전송 목록'),
(167, 'add_transport', 'add transport', 'পরিবহন যোগ করুন', 'añadir el transporte', 'إضافة النقل', 'voeg vervoer', 'добавить транспорт', '加上运输', 'taşıma ekle', 'adicionar transporte', 'hozzá a közlekedés', 'ajouter transports', 'προσθέστε μεταφορών', 'add-Transport', 'aggiungere il trasporto', 'เพิ่มการขนส่ง', 'نقل و حمل شامل', 'परिवहन जोड़', 'adde onerariis', 'tambahkan transportasi', 'トランスポートを追加', '전송을 추가'),
(168, 'route_name', 'route name', 'রুট নাম', 'nombre de la ruta', 'اسم توجيه', 'naam van de route', 'Имя маршрут', '路由名称', 'rota ismi', 'nome da rota', 'útvonal nevét', 'nom de la route', 'Όνομα διαδρομής', 'Routennamen', 'nome del percorso', 'ชื่อเส้นทาง', 'راستے نام', 'मार्ग का नाम', 'iter nomine', 'Nama rute', 'ルートの名前', '경로 이름'),
(169, 'number_of_vehicle', 'number of vehicle', 'গাড়ীর সংখ্যা', 'número de vehículo', 'عدد من المركبات', 'aantal voertuigkilometers', 'количество автомобиля', '车辆的数量', 'Aracın sayısı', 'número de veículo', 'számú gépjármű', 'nombre de véhicules', 'αριθμός των οχημάτων', 'Anzahl der Fahrzeug', 'numero di veicolo', 'จำนวนของยานพาหนะ', 'گاڑی کی تعداد', 'वाहन की संख्या', 'de numero scilicet vehiculum', 'jumlah kendaraan', '車両の数', '차량의 수'),
(170, 'route_fare', 'route fare', 'রুট করবেন', 'ruta hacer', 'المسار تفعل', 'route doen', 'маршрут делать', '路线做', 'yol yapmak', 'rota fazer', 'útvonal do', 'itinéraire faire', 'διαδρομή κάνει', 'Route zu tun', 'r', 'เส้นทางทำ', 'راستے کرتے', 'मार्ग करना', 'iter faciunt,', 'rute lakukan', 'ルートか', '경로는 할'),
(171, 'edit_transport', 'edit transport', 'সম্পাদনা পরিবহন', 'transporte de edición', 'النقل تحرير', 'vervoer bewerken', 'править транспорт', '编辑运输', 'edit ulaşım', 'edição transporte', 'szerkesztés szállítás', 'transport modifier', 'edit μεταφορών', 'edit Transport', 'modifica dei trasporti', 'แก้ไขการขนส่ง', 'ترمیم نقل و حمل', 'संपादित परिवहन', 'edit onerariis', 'mengedit transportasi', '編集輸送', '편집 전송'),
(172, 'manage_dormitory', 'manage dormitory', 'আস্তানা ও পরিচালনা', 'gestionar dormitorio', 'إدارة الإقامة', 'beheren slaapzaal', 'управлять общежитие', '宿舍管理', 'yurt yönetmek', 'gerenciar dormitório', 'kezelni kollégiumi', 'gérer dortoir', 'διαχείριση κοιτώνα', 'Schlafsaal verwalten', 'gestione dormitorio', 'จัดการหอพัก', 'شیناگار کا انتظام', 'छात्रावास का प्रबंधन', 'curo dormitorio', 'mengelola asrama', '寮を管理', '기숙사를 관리'),
(173, 'dormitory_list', 'dormitory list', 'আস্তানা তালিকা', 'lista dormitorio', 'قائمة الإقامة', 'slaapzaal lijst', 'Список общежитие', '宿舍名单', 'yurt listesi', 'lista dormitório', 'kollégiumi lista', 'liste de dortoir', 'Λίστα κοιτώνα', 'Schlafsaal Liste', 'elenco dormitorio', 'รายชื่อหอพัก', 'شیناگار فہرست', 'छात्रावास सूची', 'dormitorium album', 'daftar asrama', '寮のリスト', '기숙사 목록'),
(174, 'add_dormitory', 'add dormitory', 'আস্তানা যোগ', 'añadir dormitorio', 'إضافة إقامة', 'voeg slaapzaal', 'добавить общежитие', '添加宿舍', 'yurt ekle', 'adicionar dormitório', 'hozzá kollégiumi', 'ajouter dortoir', 'προσθήκη κοιτώνα', 'Schlaf hinzufügen', 'aggiungere dormitorio', 'เพิ่มหอพัก', 'شیناگار شامل', 'छात्रावास जोड़', 'adde dormitorio', 'menambahkan asrama', '寮を追加', '기숙사를 추가'),
(175, 'dormitory_name', 'dormitory name', 'আস্তানা নাম', 'Nombre del dormitorio', 'اسم الإقامة', 'slaapzaal naam', 'Имя общежитие', '宿舍名', 'yurt adı', 'nome dormitório', 'kollégiumi név', 'nom de dortoir', 'Όνομα κοιτώνα', 'Schlaf Namen', 'Nome dormitorio', 'ชื่อหอพัก', 'شیناگار نام', 'छात्रावास नाम', 'dormitorium nomine', 'Nama asrama', '寮名', '기숙사 이름'),
(176, 'number_of_room', 'number of room', 'ঘরের সংখ্যা', 'número de habitación', 'عدد الغرف', 'aantal kamer', 'число комнате', '房间数量', 'oda sayısı', 'número de quarto', 'száma szobában', 'nombre de salle', 'τον αριθμό των δωματίων', 'Anzahl der Zimmer', 'numero delle camera', 'จำนวนห้องพัก', 'کمرے کی تعداد', 'कमरे की संख्या', 'numerus locus', 'Jumlah kamar', 'お部屋数', '객실 수'),
(177, 'manage_noticeboard', 'manage noticeboard', 'নোটিশবোর্ড পরিচালনা', 'gestionar tablón de anuncios', 'إدارة التنبيهات', 'beheren prikbord', 'управлять доске объявлений', '管理布告', 'Noticeboard yönetmek', 'gerenciar avisos', 'kezelni üzenőfalán', 'gérer panneau d''affichage', 'διαχείριση ανακοινώσεων', 'Brett verwalten', 'gestione bacheca', 'จัดการป้ายประกาศ', 'noticeboard کا انتظام', 'Noticeboard का प्रबंधन', 'curo noticeboard', 'mengelola pengumuman', '伝言板を管理', '의 noticeboard 관리'),
(178, 'noticeboard_list', 'noticeboard list', 'নোটিশবোর্ড তালিকা', 'tablón de anuncios de la lista', 'قائمة التنبيهات', 'prikbord lijst', 'Список доска для объявлений', '布告名单', 'noticeboard listesi', 'lista de avisos', 'üzenőfalán lista', 'liste de panneau d''affichage', 'λίστα ανακοινώσεων', 'Brett-Liste', 'elenco bacheca', 'รายการป้ายประกาศ', 'noticeboard فہرست', 'Noticeboard सूची', 'noticeboard album', 'daftar pengumuman', '伝言板一覧', '의 noticeboard 목록'),
(179, 'add_noticeboard', 'add noticeboard', 'নোটিশবোর্ড যোগ', 'añadir tablón de anuncios', 'إضافة الإشعارات', 'voeg prikbord', 'добавить доске объявлений', '添加布告', 'Noticeboard ekle', 'adicionar avisos', 'hozzá üzenőfalán', 'ajouter panneau d''affichage', 'προσθήκη ανακοινώσεων', 'Brett hinzufügen', 'aggiungere bacheca', 'เพิ่มป้ายประกาศ', 'noticeboard شامل', 'Noticeboard जोड़', 'adde noticeboard', 'menambahkan pengumuman', '伝言板を追加', '의 noticeboard 추가'),
(180, 'notice', 'notice', 'বিজ্ঞপ্তি', 'aviso', 'إشعار', 'kennisgeving', 'уведомление', '通知', 'uyarı', 'aviso', 'értesítés', 'délai', 'ειδοποίηση', 'Bekanntmachung', 'avviso', 'แจ้งให้ทราบ', 'نوٹس', 'नोटिस', 'Observa', 'pemberitahuan', '予告', '통지'),
(181, 'add_notice', 'add notice', 'নোটিশ যোগ করুন', 'añadir aviso', 'إضافة إشعار', 'voeg bericht', 'добавить уведомление', '添加通知', 'haber ekle', 'adicionar aviso', 'hozzá értesítés', 'ajouter un avis', 'προσθέστε ανακοίνωση', 'Hinweis hinzufügen', 'aggiungere preavviso', 'เพิ่มแจ้งให้ทราบล่วงหน้า', 'نوٹس کا اضافہ کریں', 'नोटिस जोड़', 'addunt et titulum', 'tambahkan pemberitahuan', '通知を追加', '통지를 추가'),
(182, 'edit_noticeboard', 'edit noticeboard', 'সম্পাদনা নোটিশবোর্ড', 'edit tablón de anuncios', 'تحرير اللافتة', 'bewerk prikbord', 'править доска для объявлений', '编辑布告', 'edit noticeboard', 'edição de avisos', 'szerkesztés üzenőfalán', 'modifier panneau d''affichage', 'edit ανακοινώσεων', 'Brett bearbeiten', 'modifica bacheca', 'แก้ไขป้ายประกาศ', 'میں ترمیم کریں noticeboard', 'संपादित Noticeboard', 'edit noticeboard', 'mengedit pengumuman', '編集伝言板', '편집의 noticeboard'),
(183, 'system_name', 'system name', 'সিস্টেমের নাম', 'Nombre del sistema', 'اسم النظام', 'Name System', 'Имя системы', '系统名称', 'sistemi adı', 'nome do sistema', 'rendszer neve', 'nom du système', 'όνομα του συστήματος', 'Systemnamen', 'nome del sistema', 'ชื่อระบบ', 'نظام کا نام', 'सिस्टम नाम', 'ratio nominis', 'Nama sistem', 'システム名', '시스템 이름'),
(184, 'save', 'save', 'রক্ষা', 'guardar', 'حفظ', 'besparen', 'экономить', '节省', 'kurtarmak', 'salvar', 'kivéve', 'sauver', 'εκτός', 'sparen', 'salvare', 'ประหยัด', 'کو بچانے کے', 'बचाना', 'salvum', 'menyimpan', '保存', '저장'),
(185, 'system_title', 'system title', 'সিস্টেম শিরোনাম', 'Título de sistema', 'عنوان النظام', 'systeem titel', 'Название системы', '系统标题', 'Sistem başlık', 'título sistema', 'rendszer cím', 'titre du système', 'Τίτλος του συστήματος', 'System-Titel', 'titolo di sistema', 'ชื่อระบบ', 'نظام عنوان', 'सिस्टम शीर्षक', 'ratio title', 'title sistem', 'システムのタイトル', '시스템 제목'),
(186, 'paypal_email', 'paypal email', 'PayPal ইমেইল', 'paypal email', 'باي بال البريد الإلكتروني', 'paypal e-mail', 'PayPal по электронной почте', 'PayPal电子邮件', 'paypal e-posta', 'paypal e-mail', 'paypal email', 'paypal email', 'paypal ηλεκτρονικό ταχυδρομείο', 'paypal E-Mail', 'paypal-mail', 'paypal อีเมล์', 'پے پال ای میل', 'पेपैल ईमेल', 'Paypal email', 'email paypal', 'Paypalのメール', '페이팔 이메일'),
(187, 'currency', 'currency', 'মুদ্রা', 'moneda', 'عملة', 'valuta', 'валюта', '货币', 'para', 'moeda', 'valuta', 'monnaie', 'νόμισμα', 'Währung', 'valuta', 'เงินตรา', 'کرنسی', 'मुद्रा', 'currency', 'mata uang', '通貨', '통화'),
(188, 'phrase_list', 'phrase list', 'ফ্রেজ তালিকা', 'lista de frases', 'قائمة جملة', 'zinnenlijst', 'Список фраза', '短语列表', 'ifade listesi', 'lista de frases', 'kifejezés lista', 'liste de phrase', 'Λίστα φράση', 'Phrasenliste', 'elenco frasi', 'รายการวลี', 'جملہ فہرست', 'वाक्यांश सूची', 'dicitur album', 'Daftar frase', 'フレーズリスト', '문구 목록'),
(189, 'add_phrase', 'add phrase', 'শব্দগুচ্ছ যুক্ত', 'añadir la frase', 'إضافة عبارة', 'voeg zin', 'добавить фразу', '添加词组', 'ifade eklemek', 'adicionar frase', 'adjunk kifejezést', 'ajouter la phrase', 'προσθέστε φράση', 'Begriff hinzufügen', 'aggiungere la frase', 'เพิ่มวลี', 'جملہ شامل', 'वाक्यांश जोड़ना', 'addere phrase', 'menambahkan frase', 'フレーズを追加', '문구를 추가'),
(190, 'add_language', 'add language', 'ভাষা যুক্ত', 'añadir idioma', 'إضافة لغة', 'add taal', 'добавить язык', '新增语言', 'dil ekle', 'adicionar língua', 'nyelv hozzáadása', 'ajouter la langue', 'προσθέστε γλώσσα', 'Sprache hinzufügen', 'aggiungere la lingua', 'เพิ่มภาษา', 'زبان کو شامل', 'भाषा जोड़ना', 'addere verbis', 'menambahkan bahasa', '言語を追加', '언어를 추가'),
(191, 'phrase', 'phrase', 'বাক্য', 'frase', 'العبارة', 'frase', 'фраза', '短语', 'ifade', 'frase', 'kifejezés', 'phrase', 'φράση', 'Ausdruck', 'frase', 'วลี', 'جملہ', 'वाक्यांश', 'phrase', 'frasa', 'フレーズ', '구'),
(192, 'manage_backup_restore', 'manage backup restore', 'ব্যাকআপ পুনঃস্থাপন ও পরিচালনা', 'gestionar copias de seguridad a restaurar', 'إدارة استعادة النسخ الاحتياطي', 'beheer van back-up herstellen', 'управлять восстановить резервного копирования', '管理备份恢复', 'yedekleme geri yönetmek', 'gerenciar o backup de restauração', 'kezelni a biztonsági mentés visszaállítása', 'gérer de restauration de sauvegarde', 'διαχείριση επαναφοράς αντιγράφων ασφαλείας', 'verwalten Backup wiederherstellen', 'gestire il ripristino di backup', 'จัดการการสำรองข้อมูลเรียกคืน', 'بیک اپ بحال انتظام', 'बैकअप बहाल का प्रबंधन', 'curo tergum restituunt', 'mengelola backup restore', 'バックアップ、リストアを管理', '백업 복원 관리'),
(193, 'restore', 'restore', 'প্রত্যর্পণ করা', 'restaurar', 'استعادة', 'herstellen', 'восстановление', '恢复', 'geri', 'restaurar', 'visszaad', 'restaurer', 'επαναφέρετε', 'wiederherstellen', 'ripristinare', 'ฟื้นฟู', 'بحال', 'बहाल', 'reddite', 'mengembalikan', '復元する', '복원'),
(194, 'mark', 'mark', 'ছাপ', 'marca', 'علامة', 'mark', 'знак', '标志', 'işaret', 'marca', 'jel', 'marque', 'σημάδι', 'Marke', 'marchio', 'เครื่องหมาย', 'نشان', 'निशान', 'Marcus', 'tanda', 'マーク', '표'),
(195, 'grade', 'grade', 'গ্রেড', 'grado', 'درجة', 'graad', 'класс', '等级', 'sınıf', 'grau', 'fokozat', 'grade', 'βαθμός', 'Klasse', 'grado', 'เกรด', 'گریڈ', 'ग्रेड', 'gradus,', 'kelas', 'グレード', '학년'),
(196, 'invoice', 'invoice', 'চালান', 'factura', 'فاتورة', 'factuur', 'счет-фактура', '发票', 'fatura', 'fatura', 'számla', 'facture', 'τιμολόγιο', 'Rechnung', 'fattura', 'ใบกำกับสินค้า', 'انوائس', 'बीजक', 'cautionem', 'faktur', 'インボイス', '송장'),
(197, 'book', 'book', 'বই', 'libro', 'كتاب', 'boek', 'книга', '书', 'kitap', 'livro', 'könyv', 'livre', 'βιβλίο', 'Buch', 'libro', 'หนังสือ', 'کتاب', 'किताब', 'Liber', 'buku', '本', '책'),
(198, 'all', 'all', 'সব', 'todo', 'كل', 'alle', 'все', '所有', 'tüm', 'tudo', 'minden', 'tout', 'όλα', 'alle', 'tutto', 'ทั้งหมด', 'تمام', 'सब', 'omnes', 'semua', 'すべて', '모든'),
(199, 'upload_&_restore_from_backup', 'upload & restore from backup', 'আপলোড &amp; ব্যাকআপ থেকে পুনঃস্থাপন', 'cargar y restaurar copia de seguridad', 'تحميل واستعادة من النسخة الاحتياطية', 'uploaden en terugzetten van een backup', 'загрузить и восстановить из резервной копии', '上传及从备份中恢复', 'yükleyebilir ve yedekten geri yükleme', 'fazer upload e restauração de backup', 'feltölteni és visszaállítani backup', 'télécharger et restauration de la sauvegarde', 'ανεβάσετε και επαναφορά από backup', 'Upload &amp; Wiederherstellung von Backups', 'caricare e ripristinare dal backup', 'อัปโหลดและเรียกคืนจากการสำรองข้อมูล', 'اپ لوڈ کریں اور بیک اپ سے بحال', 'अपलोड और बैकअप से बहाल', 'restituo ex tergum upload,', 'meng-upload &amp; restore dari backup', 'アップロード＆バックアップから復元', '업로드 및 백업에서 복원'),
(200, 'manage_profile', 'manage profile', 'প্রফাইলটি পরিচালনা', 'gestionar el perfil', 'إدارة الملف الشخصي', 'te beheren!', 'управлять профилем', '管理配置文件', 'profilini yönetmek', 'gerenciar o perfil', 'Profil kezelése', 'gérer le profil', 'διαχειριστείτε το προφίλ', 'Profil verwalten', 'gestire il profilo', 'จัดการรายละเอียด', 'پروفائل کا نظم کریں', 'प्रोफाइल का प्रबंधन', 'curo profile', 'mengelola profil', 'プロファイル（個人情報）の管理', '프로필 (내 정보) 관리'),
(201, 'update_profile', 'update profile', 'প্রোফাইল আপডেট', 'actualizar el perfil', 'تحديث الملف الشخصي', 'Profiel bijwerken', 'обновить профиль', '更新个人资料', 'profilinizi güncelleyin', 'atualizar o perfil', 'frissíteni profil', 'mettre à jour le profil', 'ενημερώσετε το προφίλ', 'Profil aktualisieren', 'aggiornare il profilo', 'อัปเดตโปรไฟล์', 'پروفائل کو اپ ڈیٹ', 'प्रोफ़ाइल अपडेट', 'magna eget ipsum', 'memperbarui profil', 'プロファイルを更新', '프로필을 업데이트'),
(202, 'new_password', 'new password', 'নতুন পাসওয়ার্ড', 'nueva contraseña', 'كلمة مرور جديدة', 'nieuw wachtwoord', 'новый пароль', '新密码', 'Yeni şifre', 'nova senha', 'Új jelszó', 'nouveau mot de passe', 'νέο κωδικό', 'Neues Passwort', 'nuova password', 'รหัสผ่านใหม่', 'نیا پاس ورڈ', 'नया पासवर्ड', 'novum password', 'kata sandi baru', '新しいパスワード', '새 암호'),
(203, 'confirm_new_password', 'confirm new password', 'নতুন পাসওয়ার্ড নিশ্চিত করুন', 'confirmar nueva contraseña', 'تأكيد كلمة المرور الجديدة', 'Bevestig nieuw wachtwoord', 'подтвердить новый пароль', '确认新密码', 'yeni parolayı onaylayın', 'confirmar nova senha', 'erősítse meg az új jelszót', 'confirmer le nouveau mot de passe', 'επιβεβαιώσετε το νέο κωδικό', 'Bestätigen eines neuen Kennwortes', 'conferma la nuova password', 'ยืนยันรหัสผ่านใหม่', 'نئے پاس ورڈ کی توثیق', 'नए पासवर्ड की पुष्टि', 'confirma novum password', 'konfirmasi password baru', '新しいパスワードを確認', '새 암호를 확인합니다');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(204, 'update_password', 'update password', 'পাসওয়ার্ড আপডেট', 'actualizar la contraseña', 'تحديث كلمة السر', 'updaten wachtwoord', 'обновить пароль', '更新密码', 'Parolanızı güncellemek', 'atualizar senha', 'frissíti jelszó', 'mettre à jour le mot de passe', 'ενημερώσετε τον κωδικό πρόσβασης', 'Kennwort aktualisieren', 'aggiornare la password', 'ปรับปรุงรหัสผ่าน', 'پاس اپ ڈیٹ', 'पासवर्ड अद्यतन', 'scelerisque eget', 'memperbarui sandi', 'パスワードを更新', '암호를 업데이트'),
(205, 'teacher_dashboard', 'teacher dashboard', 'শিক্ষক ড্যাশবোর্ড', 'tablero maestro', 'لوحة تحكم المعلم', 'leraar dashboard', 'учитель приборной панели', '老师仪表板', 'öğretmen pano', 'dashboard professor', 'tanár műszerfal', 'enseignant tableau de bord', 'ταμπλό των εκπαιδευτικών', 'Lehrer-Dashboard', 'dashboard insegnante', 'กระดานครู', 'استاد ڈیش بورڈ', 'शिक्षक डैशबोर्ड', 'magister Dashboard', 'dashboard guru', '教師のダッシュボード', '교사 대시 보드'),
(206, 'backup_restore_help', 'backup restore help', 'ব্যাকআপ পুনঃস্থাপন সাহায্য', 'copia de seguridad restaurar ayuda', 'استعادة النسخ الاحتياطي المساعدة', 'backup helpen herstellen', 'восстановить резервную копию помощь', '备份恢复的帮助', 'yedekleme yardım geri', 'de backup restaurar ajuda', 'Backup Restore segítségével', 'restauration de sauvegarde de l''aide', 'επαναφοράς αντιγράφων ασφαλείας βοήθεια', 'Backup wiederherstellen Hilfe', 'Backup Restore aiuto', 'การสำรองข้อมูลเรียกคืนความช่วยเหลือ', 'بیک اپ کی مدد بحال', 'बैकअप मदद बहाल', 'auxilium tergum restituunt', 'backup restore bantuan', 'バックアップヘルプを復元', '백업 도움을 복원'),
(207, 'student_dashboard', 'student dashboard', 'ছাত্র ড্যাশবোর্ড', 'salpicadero estudiante', 'لوحة القيادة الطلابية', 'student dashboard', 'студент приборной панели', '学生的仪表板', 'Öğrenci paneli', 'dashboard estudante', 'tanuló műszerfal', 'tableau de bord de l''élève', 'ταμπλό των φοιτητών', 'Schüler Armaturenbrett', 'studente dashboard', 'แผงควบคุมนักเรียน', 'طالب علم کے ڈیش بورڈ', 'छात्र डैशबोर्ड', 'Discipulus Dashboard', 'dashboard mahasiswa', '学生のダッシュボード', '학생 대시 보드'),
(208, 'parent_dashboard', 'parent dashboard', 'অভিভাবক ড্যাশবোর্ড', 'salpicadero padres', 'لوحة تحكم ولي الأمر ', 'ouder dashboard', 'родитель приборной панели', '家长仪表板', 'ebeveyn kontrol paneli', 'dashboard pai', 'szülő műszerfal', 'parent tableau de bord', 'μητρική ταμπλό', 'Mutter Armaturenbrett', 'dashboard genitore', 'แผงควบคุมของผู้ปกครอง', 'والدین کے ڈیش بورڈ', 'माता - पिता डैशबोर्ड', 'Dashboard parent', 'orangtua dashboard', '親ダッシュ', '부모 대시 보드'),
(209, 'view_marks', 'view marks', 'দেখুন চিহ্ন', 'Vista marcas', 'علامات رأي', 'view merken', 'вид знаки', '鉴于商标', 'görünümü işaretleri', 'vista marcas', 'view jelek', 'Vue marques', 'σήματα άποψη', 'Ansicht Marken', 'Vista marchi', 'เครื่องหมายมุมมอง', 'دیکھیں نشانات', 'देखने के निशान', 'propter signa', 'lihat tanda', 'ビューマーク', '보기 마크'),
(210, 'delete_language', 'delete language', 'ভাষা মুছতে', 'eliminar el lenguaje', 'حذف اللغة', 'verwijderen taal', 'удалить язык', '删除语言', 'dili silme', 'excluir língua', 'törlése nyelv', 'supprimer la langue', 'διαγραφή γλώσσα', 'Sprache löschen', 'eliminare lingua', 'ลบภาษา', 'زبان کو خارج کر دیں', 'भाषा को हटाना', 'linguam turpis', 'menghapus bahasa', '言語を削除する', '언어를 삭제'),
(211, 'settings_updated', 'settings updated', 'সেটিংস আপডেট', 'configuración actualizado', 'الإعدادات المحدثة', 'instellingen bijgewerkt', 'Настройки обновлены', '设置更新', 'ayarları güncellendi', 'definições atualizadas', 'beállítások frissítve', 'paramètres mis à jour', 'Ρυθμίσεις ενημέρωση', 'Einstellungen aktualisiert', 'impostazioni aggiornate', 'การตั้งค่าการปรับปรุง', 'ترتیبات کی تازہ کاری', 'सेटिंग्स अद्यतन', 'venenatis eu', 'pengaturan diperbarui', '設定が更新', '설정이 업데이트'),
(212, 'update_phrase', 'update phrase', 'আপডেট ফ্রেজ', 'actualización de la frase', 'تحديث العبارة', 'Update zin', 'обновление фраза', '更新短语', 'güncelleme ifade', 'atualização frase', 'frissítést kifejezés', 'mise à jour phrase', 'ενημέρωση φράση', 'Update Begriff', 'aggiornamento frase', 'ปรับปรุงวลี', 'اپ ڈیٹ جملہ', 'अद्यतन वाक्यांश', 'eget dictum', 'frase pembaruan', '更新フレーズ', '업데이트 구문'),
(213, 'login_failed', 'login failed', 'লগইন ব্যর্থ হয়েছে', 'Error de acceso', 'فشل تسجيل الدخول', 'inloggen is mislukt', 'Ошибка входа', '登录失败', 'giriş başarısız oldu', 'Falha no login', 'bejelentkezés sikertelen', 'Échec de la connexion', 'Είσοδος απέτυχε', 'Fehler bei der Anmeldung', 'Accesso non riuscito', 'เข้าสู่ระบบล้มเหลว', 'لاگ ان ناکام', 'लॉगिन विफल', 'tincidunt defecit', 'Login gagal', 'ログインに失敗しました', '로그인 실패'),
(214, 'live_chat', 'live chat', 'লাইভ চ্যাট', 'chat en vivo', 'الدردشة الحية', 'live chat', 'Онлайн-чат', '即时聊天', 'canlı sohbet', 'chat ao vivo', 'élő chat', 'chat en direct', 'live chat', 'Live-Chat', 'live chat', 'อยู่สนทนา', 'لائیو چیٹ', 'लाइव चैट', 'Vivamus nibh', 'live chat', 'ライブチャット', '라이브 채팅'),
(215, 'client 1', 'client 1', 'ক্লায়েন্টের 1', 'cliente 1', 'العميل 1', 'client 1', 'Клиент 1', '客户端1', 'istemcisi 1', 'cliente 1', 'ügyfél 1', 'client 1', 'πελάτη 1', 'Client 1', 'client 1', 'ลูกค้า 1', 'کلائنٹ 1', 'ग्राहक 1', 'I huius', 'client 1', 'クライアント1', '클라이언트 1'),
(216, 'buyer', 'buyer', 'ক্রেতা', 'comprador', 'مشتر', 'koper', 'покупатель', '买方', 'alıcı', 'comprador', 'vevő', 'acheteur', 'αγοραστής', 'Käufer', 'compratore', 'ผู้ซื้อ', 'خریدار', 'खरीददार', 'qui emit,', 'pembeli', 'バイヤー', '구매자'),
(217, 'purchase_code', 'purchase code', 'ক্রয় কোড', 'código de compra', 'كود الشراء', 'aankoop code', 'покупка код', '申购代码', 'satın alma kodu', 'código de compra', 'vásárlási kódot', 'code d''achat', 'Κωδικός αγορά', 'Kauf-Code', 'codice di acquisto', 'รหัสการสั่งซื้อ', 'خریداری کے کوڈ', 'खरीद कोड', 'Mauris euismod', 'kode pembelian', '購入コード', '구매 코드'),
(218, 'system_email', 'system email', 'সিস্টেম ইমেইল', 'correo electrónico del sistema', 'نظام البريد الإلكتروني', 'systeem e-mail', 'система электронной почты', '邮件系统', 'sistem e-posta', 'e-mail do sistema', 'a rendszer az e-mail', 'email de système', 'e-mail συστήματος', 'E-Mail-System', 'email sistema', 'อีเมล์ระบบ', 'نظام کی ای میل', 'प्रणाली ईमेल', 'Praesent sit amet', 'email sistem', 'システムの電子メール', '시스템 전자 메일'),
(219, 'option', 'option', 'বিকল্প', 'opción', 'خيار', 'optie', 'вариант', '选项', 'seçenek', 'opção', 'opció', 'option', 'επιλογή', 'Option', 'opzione', 'ตัวเลือกที่', 'آپشن', 'विकल्प', 'optio', 'pilihan', 'オプション', '선택권'),
(220, 'edit_phrase', 'edit phrase', 'সম্পাদনা ফ্রেজ', 'edit frase', 'تحرير العبارة', 'bewerk zin', 'править фраза', '编辑语', 'edit ifade', 'edição frase', 'szerkesztés kifejezés', 'modifier phrase', 'edit φράση', 'edit Begriff', 'modifica frase', 'แก้ไขวลี', 'ترمیم کے جملہ', 'संपादित वाक्यांश', 'edit phrase', 'mengedit frase', '編集フレーズ', '편집 구'),
(221, 'About', '', '', '', 'عن الشركة', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(222, 'CopyRights', '', '', '', 'حقوق النسخ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(223, 'About The System', '', '', '', 'عن النظام ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(224, 'Live Support', '', '', '', 'دعم فني مباشر ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(225, 'Suggetion ', '', '', '', 'الإقتراحات والشكاوي', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(226, 'Support', '', '', '', 'الدعم الفني ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(227, 'account_not_found', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(228, 'select_account_type', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `stage_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`stage_id`, `level_id`, `level_name`) VALUES
(1, 1, 'first level'),
(1, 2, 'second level'),
(1, 3, 'level three'),
(1, 4, 'level four'),
(1, 5, 'level five'),
(1, 6, 'level six'),
(2, 1, 'first secondary  level'),
(2, 2, 'second secondary  level'),
(2, 3, 'third secondary  level');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
`mark_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark_obtained` int(11) NOT NULL DEFAULT '0',
  `mark_total` int(11) NOT NULL DEFAULT '100',
  `attendance` int(11) NOT NULL DEFAULT '0',
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
`notice_id` int(11) NOT NULL,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`notice_id`, `notice_title`, `notice`, `create_timestamp`) VALUES
(1, 'Graduation ceremony ', 'Dears , Congratulation , this is the yearly ceremony <br>', 1402531200),
(2, 'Summer Activities', 'Dear Students&nbsp; , Summer Activities will start from today <br>', 1403222400);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
`id` int(11) NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`) VALUES
(1, 'site_url', 'http://localhost/system'),
(2, 'default_language', 'english');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
`parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `relation_with_student` longtext COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `student_id`, `relation_with_student`, `profession`) VALUES
(1, 1, 'Father', 'Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`payment_id` int(11) NOT NULL,
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Smart School'),
(2, 'system_title', 'Smart School'),
(3, 'address', 'Smart Village , Egypt'),
(4, 'phone', '+2 01151521600'),
(5, 'paypal_email', 'school@smart.com.eg'),
(6, 'currency', 'usd'),
(7, 'system_email', 'school@smart.com.eg');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE IF NOT EXISTS `stages` (
  `stage_id` int(11) NOT NULL,
  `stage_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`stage_id`, `stage_name`) VALUES
(1, 'primary'),
(2, 'secondary');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`student_id` int(11) NOT NULL,
  `father_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `roll` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transport_id` int(11) NOT NULL,
  `dormitory_id` int(11) NOT NULL,
  `dormitory_room_number` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `father_name`, `mother_name`, `class_id`, `roll`, `transport_id`, `dormitory_id`, `dormitory_room_number`) VALUES
(1, 'Mohamed Ali sayed', 'Norhan Abdallah ali', '1', '1', 0, 0, ''),
(4, 'Mohamed Ali sayed', 'Norhan Abdallah ali', '1', '4344', 0, 0, ''),
(5, '222', '333', '', '444', 0, 0, ''),
(6, '', '', '', '', 0, 0, ''),
(7, 'Mohamed Ali sayed', 'Norhan Abdallah ali', '1', '4344', 0, 0, ''),
(8, '222', '333', '', '444', 0, 0, ''),
(9, '', '', '', '', 0, 0, ''),
(10, 'Mohamed Ali sayed', 'Norhan Abdallah ali', '1', '4344', 0, 0, ''),
(12, '', '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `students_installments`
--

CREATE TABLE IF NOT EXISTS `students_installments` (
  `installment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `date_payment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_installments`
--

INSERT INTO `students_installments` (`installment_id`, `student_id`, `paid`, `date_payment`) VALUES
(1, 71, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`subject_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `class_id`, `teacher_id`) VALUES
(1, 'Math', 0, 0),
(2, 'Arabic', 0, 0),
(3, 'English', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

CREATE TABLE IF NOT EXISTS `translation` (
`id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `english` varchar(200) NOT NULL,
  `arabic` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `translation`
--

INSERT INTO `translation` (`id`, `key`, `english`, `arabic`) VALUES
(0, 'home', 'Home', 'الرئيسية'),
(2, 'dashboard', 'Dashboard', 'لوحة التحكم'),
(3, 'students', 'Students', 'الطلاب'),
(4, 'teacher', 'Teachers', 'المعلمين'),
(5, 'parents', 'parents', 'أولياء الامور'),
(6, 'users', 'Users', 'المستخدمون'),
(7, 'time_table', 'Time Table', 'الجدول'),
(8, 'messages', 'Messages', 'الرسائل'),
(9, 'buses', 'Buses', 'الاتوبيسات'),
(11, 'finicial', 'Finicial', 'المصروفات'),
(12, 'translation', 'Translation', 'الترجمة'),
(13, 'id', 'ID', 'الرقم'),
(18, 'name', 'Name', 'الاسم'),
(19, 'email', 'Email', 'الايميل'),
(21, 'Smart', 'School Name sss', 'إسم المدرسة '),
(29, '55', '666', '7787');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
`transport_id` int(11) NOT NULL,
  `route_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number_of_vehicle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `route_fare` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`transport_id`, `route_name`, `number_of_vehicle`, `description`, `route_fare`) VALUES
(1, 'Omar Ahmed taher', '28', '', '6 october, Dream land , maryotia , haram , giza');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `bus_fees` int(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `class_id` varchar(50) NOT NULL DEFAULT '1',
  `last_login` varchar(50) DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT '1',
  `name` varchar(50) NOT NULL,
  `groups` varchar(100) DEFAULT 'not_defined',
  `phone` varchar(20) DEFAULT NULL,
  `national_id` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `blood_group` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `stage` varchar(50) NOT NULL DEFAULT '1',
  `level` varchar(50) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=616 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bus_fees`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `class_id`, `last_login`, `active`, `name`, `groups`, `phone`, `national_id`, `photo`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `stage`, `level`) VALUES
(46, 0, 'admin', '$2y$08$ofb/opJfPW/xwrK46lLChuEkbFqiYgaDKYllFeiAn4C5S8sVQoYK.', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '14', '2014/09/30 09:09:50', 1, 'mohamed gomah agamy', 'admin', '999999999', '88888888', '14-09-29-05-09-52_2876452_Desert.jpg', '1/1/1992', 'male', 'Muslim', 'o', 'fayoum,egypt', '1', '1'),
(59, 800, 'aaaa', '$2y$08$KP6/Oz/qLD1L1A4GE2r2VOGiVTdhmO9poVDXT79y6GSX4MJFpiHsO', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '1', '2014/09/28 08:09:15', 1, 'ali gamal mostafa', 'student', '111111111111', '111111111111111', '', '1/1/2001', 'male', 'Muslim', 'a', 'aaaaaaaaaa', '2', '2'),
(64, 0, 'ahmed', '$2y$08$EHV2V1VbFQ.vDok/qiM4Fe9BCMyjC1RpQpbUXtt1T4daZqbRbqD02', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '14', '14/09/17 02:09:34', 1, 'ahmed gamal', 'teacher', '', '121232423', '', '1/1/2002', 'male', 'Muslim', 'e', 'giza', '1', '1'),
(65, 0, '4444', '$2y$08$.TUrFt38TJhU7CohUasyAu9RPhbAglqn61YRjt6YXnjvfpvB2pYpy', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '14', '2014/09/29 05:09:18', 1, 'aaaaaaaa', 'parent', NULL, '4444', '14-09-29-06-09-03_14643454_Chrysanthemum.jpg', '2/2/2005', 'male', '', 'b', 'alex', '1', '1'),
(68, 0, 'admin', '$2y$08$XVYSCAJHGtmTAkIc2kCCjeK53GTWU9alet6ZVX.nrRFgMwnFzD4pO', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '4', '2014/09/28 08:09:52', 1, 'mohamed gomah ', 'student', '', '', '', '999999999', 'male', 'Muslim', '', '', '1', '5'),
(69, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(70, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', NULL, '555', '5555', '', '555', 'male', 'Muslim', 'i', '555', '1', '1'),
(71, 800, '4444', '$2y$08$7EiJCgWwWacITEdodgiPEepOOhOyBneZnWUp98e96/9PSnyLgt4.q', NULL, 'noha@yahoo.com', NULL, NULL, NULL, NULL, '3', '2014/09/28 04:09:09', 1, 'noha', 'student', '353454543454345', '4655645645645645', '', '2', 'female', 'Muslim', 'c', '1', '2', '3'),
(72, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', NULL, '34444', '45555', '', '777777', 'male', 'Muslim', 'o', '3333', '1', '1'),
(74, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(75, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(76, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(77, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(78, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(79, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(80, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(81, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(82, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(83, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(84, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(85, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(86, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(87, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(88, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(89, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(90, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(91, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(92, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(93, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(94, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(95, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(96, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(97, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(98, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(99, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(100, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(101, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(102, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(103, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(104, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(105, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(106, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(107, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(108, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(109, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(110, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(111, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(112, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(113, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(114, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(115, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(116, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(117, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(118, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(119, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(120, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(121, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(122, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(123, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(124, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(125, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(126, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(127, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(128, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(129, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(130, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(131, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(132, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(133, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(134, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(135, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(136, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(137, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(138, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(139, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(140, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(141, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(142, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(143, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(144, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(145, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(146, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(147, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(148, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(149, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(150, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(151, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(152, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', '', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(153, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(154, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(155, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(156, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(157, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(158, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(159, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(160, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(161, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(162, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(163, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(164, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(165, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(166, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(167, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(168, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(169, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(170, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(171, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(172, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(173, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(174, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(175, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(176, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(177, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(178, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(179, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(180, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(181, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(182, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(183, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(184, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(185, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(186, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(187, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(188, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(189, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(190, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(191, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(192, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(193, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(194, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(195, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(196, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(197, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(198, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(199, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(200, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(201, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(202, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(203, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(204, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(205, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(206, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(207, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(208, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(209, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(210, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(211, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(212, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(213, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(214, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(215, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(216, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(217, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(218, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(219, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(220, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(221, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(222, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(223, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(224, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(225, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(226, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(227, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(228, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(229, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(230, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(231, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(232, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(233, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(234, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(235, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(236, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(237, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(238, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(239, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(240, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(241, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(242, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(243, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(244, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(245, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(246, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(247, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(248, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(249, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(250, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(251, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(252, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(253, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(254, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(255, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(256, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(257, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(258, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(259, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(260, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(261, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(262, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(263, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(264, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(265, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(266, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(267, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(268, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(269, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(270, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(271, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(272, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(273, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(274, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(275, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(276, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(277, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(278, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(279, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(280, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(281, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(282, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(283, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(284, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(285, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(286, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(287, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(288, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(289, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(290, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(291, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(292, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(293, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(294, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(295, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(296, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(297, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(298, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(299, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(300, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(301, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(302, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(303, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(304, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(305, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(306, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(307, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(308, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(309, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(310, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(311, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(312, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(313, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(314, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(315, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(316, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(317, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(318, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(319, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(320, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(321, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(322, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(323, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(324, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(325, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(326, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(327, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(328, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(329, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(330, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(331, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(332, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(333, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(334, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(335, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(336, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(337, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(338, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(339, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(340, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(341, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(342, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(343, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(344, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(345, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(346, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(347, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(348, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(349, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(350, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(351, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(352, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(353, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(354, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(355, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(356, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(357, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(358, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(359, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(360, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(361, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(362, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(363, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(364, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(365, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(366, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(367, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'aaaaaaaa', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(368, 0, 'aaaa', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(369, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(370, 0, 'aaaa', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(371, 0, 'ahmed', '', NULL, 'ahmed@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ahmed gamal', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1');
INSERT INTO `users` (`id`, `bus_fees`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `class_id`, `last_login`, `active`, `name`, `groups`, `phone`, `national_id`, `photo`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `stage`, `level`) VALUES
(372, 0, '4444', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(373, 0, 'admin', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ahmed', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(374, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'not_defined', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(375, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'not_defined', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(376, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'not_defined', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(377, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'not_defined', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(378, 0, '', '$2y$08$MF9lueNcDqDbxS/8U0GkzOexWwCzKKIFH966Bbo1tS2FSOYiJl15S', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '4', '2014/09/28 08:09:16', 1, 'ali gamal badr', 'student', '222222222222', '121232435445660', '', '', '', 'Muslim', '', 'cairo', '2', '3'),
(379, 0, '', '$2y$08$zro2bnCcBr.koDVzNYvo4eA.VcRwokB6bWI1z0lHXt39mhS6.an7u', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '1', '2014/09/28 02:09:18', 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'Male', 'Muslim', '', 'cairo', '1', '1'),
(380, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(381, 0, '', '$2y$08$nzPTXBViGa4DpCMBcweLo.FfbQuOG8klcFcFXVcPIXVqZgjTWZKGe', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '1', '2014/09/28 04:09:15', 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'female', 'Muslim', '', '2432423423', '1', '1'),
(382, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(383, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(384, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(385, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', '', '', '', '2432423423', '1', '1'),
(386, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', '', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(387, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', '', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(388, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', '', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(389, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', '', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(390, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'teacher', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(391, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'teacher', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(392, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'teacher', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(393, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'teacher', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(394, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(395, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(396, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', '', '', '', '2432423423', '1', '1'),
(397, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(398, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(399, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(400, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', '', '', '', '2432423423', '1', '1'),
(401, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(402, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(403, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(404, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', '', '', '', '2432423423', '1', '1'),
(405, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(406, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(407, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', '', '', '', '2432423423', '1', '1'),
(408, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(409, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(410, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(411, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', '', '', '', '2432423423', '1', '1'),
(412, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(413, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(414, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(415, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', '', '', '', '2432423423', '1', '1'),
(416, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', '', '', '', 'cairo', '1', '1'),
(417, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(418, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(419, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(420, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(421, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(422, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(423, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(424, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(425, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(426, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(427, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(428, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(429, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(430, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(431, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(432, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(433, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(434, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(435, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(436, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(437, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(438, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(439, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(440, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(441, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(442, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(443, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(444, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(445, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(446, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(447, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(448, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(449, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(450, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(451, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(452, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(453, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(454, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(455, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(456, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(457, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(458, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(459, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(460, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(461, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(462, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(463, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(464, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(465, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(466, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(467, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(468, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(469, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(470, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(471, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(472, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(473, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(474, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(475, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(476, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(477, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(478, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(479, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(480, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(481, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(482, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(483, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(484, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(485, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(486, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(487, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(488, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(489, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(490, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(491, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(492, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(493, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(494, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(495, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(496, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(497, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(498, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(499, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(500, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(501, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(502, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(503, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(504, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(505, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(506, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(507, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(508, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(509, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(510, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(511, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(512, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(513, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(514, 0, '', '$2y$08$JXCAGNyVv/.g3oWygNSYHeMfCtPopNhZJ3ttGcwbw9zw9t6HHn5mi', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '1', '2014/09/28 08:09:59', 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'female', 'Muslim', '', '2432423423', '1', '1'),
(515, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(516, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(517, 0, '', '$2y$08$iIWDE0da3WjVQq1D7qXpPOItef5KwjHzcfUVwZka2hOW/eFGGS12S', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '1', '2014/09/28 08:09:11', 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'female', 'Muslim', '', '2432423423', '1', '1'),
(518, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(519, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(520, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(521, 0, '', '$2y$08$I3QA4CraDeWayDg3FCHVJe9TlyJbhjqOVILmEcwVhy.WIlRaVUJSu', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '1', '2014/09/28 08:09:25', 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'female', 'Muslim', '', '2432423423', '1', '1'),
(522, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(523, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(524, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', '', '', '', '', '1', '1'),
(525, 0, '', '$2y$08$QWLCiqGdEw7m0jmvvijfZObylWZ3CpyyOR2RvB8B2CLBd7mdyBtMy', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '1', '2014/09/28 08:09:38', 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'female', 'Muslim', '', '2432423423', '1', '1'),
(526, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(527, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(528, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(529, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(530, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(531, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(532, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(533, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(534, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(535, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(536, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(537, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(538, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(539, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(540, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(541, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(542, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(543, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(544, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(545, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(546, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(547, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(548, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(549, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(550, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(551, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(552, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(553, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(554, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(555, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(556, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(557, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(558, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(559, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(560, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(561, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(562, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(563, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(564, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(565, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(566, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(567, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(568, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(569, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(570, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(571, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(572, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(573, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(574, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(575, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(576, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(577, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(578, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(579, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(580, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(581, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(582, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(583, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(584, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(585, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(586, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(587, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(588, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(589, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(590, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(591, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(592, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(593, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(594, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(595, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(596, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(597, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(598, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(599, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(600, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(601, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(602, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(603, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(604, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(605, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(606, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(607, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(608, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(609, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(610, 0, '', '', NULL, 'a@ali.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali gamal', 'student', '222222222222', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(611, 0, '', '', NULL, 'a@fffff.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'ali ffff', 'student', '33333333333', '121232435445660', '', '', 'male', '', '', 'cairo', '1', '1'),
(612, 0, '', '', NULL, 'admin@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'mohamed gomah agamy', 'student', NULL, '', '', '', 'male', '', '', '', '1', '1'),
(613, 0, '', '', NULL, '4444@yahoo.com', NULL, NULL, NULL, NULL, '0', NULL, 1, 'gemy', 'student', '353454543454340', '4.6556456456456e15', '', '', 'male', '', '', '2432423423', '1', '1'),
(614, 0, 'w', '$2y$08$ktpNJ7DeiekoYJEmkN/hAuL3NfTjIfVUizIV.Q.nKUNxEIgQnBVxC', NULL, 'ssss@yahoo.com', NULL, NULL, NULL, NULL, '0', '2014/09/27 07:09:30', 1, 'ssss', 'teacher', '1', '1', 'static', '1', 'male', 'Muslim', 'wwwwwwww', '1', '1', '1'),
(615, 0, '1', '$2y$08$SkrhmtxvQ.Lp1wdd2bqgkulA2A08mdCl2k.TDhuiHyYjE0cpEeVWe', NULL, '1', NULL, NULL, NULL, NULL, '0', '2014/09/27 07:09:09', 1, '2222222', 'teacher', '1', '11', 'static', '1', 'male', 'Muslim', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_forms`
--

CREATE TABLE IF NOT EXISTS `users_forms` (
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `rwx` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_forms`
--

INSERT INTO `users_forms` (`user_id`, `form_id`, `rwx`) VALUES
(1, 100, 'w');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bus_absence`
--
CREATE TABLE IF NOT EXISTS `v_bus_absence` (
`student_id` int(11)
,`day` varchar(50)
,`bus_no` varchar(11)
,`path` varchar(300)
,`name` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bus_students`
--
CREATE TABLE IF NOT EXISTS `v_bus_students` (
`name` varchar(50)
,`driver` varchar(100)
,`supervisor` varchar(100)
,`path` varchar(300)
,`student_fees` int(11)
,`school_fees` int(11)
,`national_id` varchar(50)
,`student_id` int(11)
,`bus_no` varchar(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_class_students`
--
CREATE TABLE IF NOT EXISTS `v_class_students` (
`student_name` varchar(50)
,`stage` varchar(50)
,`level` varchar(50)
,`sex` varchar(50)
,`bus_fees` int(15)
,`photo` varchar(200)
,`birthday` varchar(50)
,`national_id` varchar(50)
,`email` varchar(100)
,`phone` varchar(20)
,`class_id` int(11)
,`class_name` varchar(200)
,`student_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_installment_students`
--
CREATE TABLE IF NOT EXISTS `v_installment_students` (
`student_id` int(11)
,`paid` int(11)
,`expenses_id` int(11)
,`expenses_name` varchar(200)
,`expenses_value` int(11)
,`level` int(11)
,`stage` int(11)
,`installment_id` int(11)
,`installment_value` int(11)
,`installment_name` varchar(200)
,`class_name` varchar(200)
,`date_payment` varchar(50)
,`class_id` int(11)
,`student_name` varchar(50)
,`end_date` varchar(200)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stage_level_class`
--
CREATE TABLE IF NOT EXISTS `v_stage_level_class` (
`level` varchar(50)
,`stage` varchar(50)
,`level_name` varchar(50)
,`name` varchar(200)
,`class_id` int(11)
,`name_numeric` varchar(200)
,`teacher_id` int(11)
,`stage_name` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user_absence`
--
CREATE TABLE IF NOT EXISTS `v_user_absence` (
`day` varchar(50)
,`user_id` int(11)
,`national_id` varchar(50)
,`name` varchar(50)
,`groups` varchar(100)
,`class_name` varchar(200)
,`class_id` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `v_bus_absence`
--
DROP TABLE IF EXISTS `v_bus_absence`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bus_absence` AS select `bus_absence`.`student_id` AS `student_id`,`bus_absence`.`day` AS `day`,`v_bus_students`.`bus_no` AS `bus_no`,`v_bus_students`.`path` AS `path`,`v_bus_students`.`name` AS `name` from (`bus_absence` left join `v_bus_students` on((`v_bus_students`.`student_id` = `bus_absence`.`student_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_bus_students`
--
DROP TABLE IF EXISTS `v_bus_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bus_students` AS select `users`.`name` AS `name`,`bus`.`driver` AS `driver`,`bus`.`supervisor` AS `supervisor`,`bus`.`path` AS `path`,`bus`.`student_fees` AS `student_fees`,`bus`.`school_fees` AS `school_fees`,`users`.`national_id` AS `national_id`,`bus_students`.`student_id` AS `student_id`,`bus_students`.`bus_no` AS `bus_no` from (`bus` left join (`bus_students` left join `users` on((`bus_students`.`student_id` = `users`.`id`))) on((`bus_students`.`bus_no` = `bus`.`no`)));

-- --------------------------------------------------------

--
-- Structure for view `v_class_students`
--
DROP TABLE IF EXISTS `v_class_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_class_students` AS select `users`.`name` AS `student_name`,`users`.`stage` AS `stage`,`users`.`level` AS `level`,`users`.`sex` AS `sex`,`users`.`bus_fees` AS `bus_fees`,`users`.`photo` AS `photo`,`users`.`birthday` AS `birthday`,`users`.`national_id` AS `national_id`,`users`.`email` AS `email`,`users`.`phone` AS `phone`,`class`.`class_id` AS `class_id`,`class`.`name` AS `class_name`,`class_students`.`student_id` AS `student_id` from (`users` left join (`class` left join `class_students` on((`class_students`.`class_id` = `class`.`class_id`))) on((`class_students`.`student_id` = `users`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_installment_students`
--
DROP TABLE IF EXISTS `v_installment_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_installment_students` AS select `students_installments`.`student_id` AS `student_id`,`students_installments`.`paid` AS `paid`,`installments`.`expenses_id` AS `expenses_id`,`expenses`.`name` AS `expenses_name`,`expenses`.`value` AS `expenses_value`,`expenses`.`level` AS `level`,`expenses`.`stage` AS `stage`,`students_installments`.`installment_id` AS `installment_id`,`installments`.`value` AS `installment_value`,`installments`.`name` AS `installment_name`,`v_class_students`.`class_name` AS `class_name`,`students_installments`.`date_payment` AS `date_payment`,`v_class_students`.`class_id` AS `class_id`,`v_class_students`.`student_name` AS `student_name`,`installments`.`end_date` AS `end_date` from (((`students_installments` left join `v_class_students` on((`students_installments`.`student_id` = `v_class_students`.`student_id`))) left join `installments` on((`students_installments`.`installment_id` = `installments`.`id`))) left join `expenses` on((`installments`.`expenses_id` = `expenses`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_stage_level_class`
--
DROP TABLE IF EXISTS `v_stage_level_class`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stage_level_class` AS select `class`.`level` AS `level`,`class`.`stage` AS `stage`,`levels`.`level_name` AS `level_name`,`class`.`name` AS `name`,`class`.`class_id` AS `class_id`,`class`.`name_numeric` AS `name_numeric`,`class`.`teacher_id` AS `teacher_id`,`stages`.`stage_name` AS `stage_name` from (`class` left join (`levels` left join `stages` on((`levels`.`stage_id` = `stages`.`stage_id`))) on(((`class`.`level` = `levels`.`level_id`) and (`class`.`stage` = `levels`.`stage_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_user_absence`
--
DROP TABLE IF EXISTS `v_user_absence`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user_absence` AS select `absence`.`day` AS `day`,`absence`.`user_id` AS `user_id`,`users`.`national_id` AS `national_id`,`users`.`name` AS `name`,`users`.`groups` AS `groups`,`v_class_students`.`class_name` AS `class_name`,`v_class_students`.`class_id` AS `class_id` from ((`absence` left join `users` on((`users`.`id` = `absence`.`user_id`))) left join `v_class_students` on((`v_class_students`.`student_id` = `absence`.`user_id`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence`
--
ALTER TABLE `absence`
 ADD PRIMARY KEY (`day`,`user_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
 ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
 ADD PRIMARY KEY (`no`);

--
-- Indexes for table `bus_absence`
--
ALTER TABLE `bus_absence`
 ADD PRIMARY KEY (`student_id`,`day`);

--
-- Indexes for table `bus_students`
--
ALTER TABLE `bus_students`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_routine`
--
ALTER TABLE `class_routine`
 ADD PRIMARY KEY (`class_routine_id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `dormitory`
--
ALTER TABLE `dormitory`
 ADD PRIMARY KEY (`dormitory_id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
 ADD PRIMARY KEY (`email_template_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
 ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
 ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
 ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
 ADD PRIMARY KEY (`phrase_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
 ADD PRIMARY KEY (`stage_id`,`level_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
 ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `noticeboard`
--
ALTER TABLE `noticeboard`
 ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
 ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
 ADD PRIMARY KEY (`stage_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `students_installments`
--
ALTER TABLE `students_installments`
 ADD PRIMARY KEY (`installment_id`,`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `translation`
--
ALTER TABLE `translation`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
 ADD PRIMARY KEY (`transport_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_forms`
--
ALTER TABLE `users_forms`
 ADD PRIMARY KEY (`user_id`,`form_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `class_routine`
--
ALTER TABLE `class_routine`
MODIFY `class_routine_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dormitory`
--
ALTER TABLE `dormitory`
MODIFY `dormitory_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
MODIFY `email_template_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
MODIFY `phrase_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=229;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `translation`
--
ALTER TABLE `translation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=616;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
