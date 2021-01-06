-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2020 at 06:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `purchasing`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(25) NOT NULL,
  `reqs_id` int(25) NOT NULL,
  `role` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `reqs_id`, `role`, `name`) VALUES
(127, 130, '', '38296798 001A 10SE20 -  BUSHING, MOUNTING.pdf'),
(128, 130, '', '38296653 001A 08SE20 - BUSHING, MOUNTING.pdf'),
(129, 130, '', 'DS615638 - Bushings.pdf'),
(130, 130, '', 'DS615638 - pricing.pdf'),
(131, 130, '', 'DS615638 - quote.pdf'),
(133, 132, '', 'NEW P-149-1 Worksheet For Prototype Part Order 38293763.docx.pdf'),
(134, 132, '', 'NEW P-149-1 Worksheet For Prototype Part Order 38293763.docx.pdf'),
(135, 132, '', 'DS615643 - Inner Tie Rods.pdf'),
(136, 132, '', 'DS615643 & DS615644 - quote.pdf'),
(137, 132, '', '38293763 001AMP 05OC20 - ROD ASM, INNER TIE.pdf'),
(138, 133, '', 'DS615644 - Outer Tie Rods.pdf'),
(139, 133, '', 'DS615643 & DS615644 - quote.pdf'),
(140, 133, '', '38293764 001A 22SE20 - ROD ASM, OUTER TIE (LH).pdf'),
(141, 133, '', '38293765 001A 30SE20 - ROD ASM, OUTER TIE (RH).pdf'),
(142, 133, '', 'NEW P-149-1 Worksheet For Prototype Part Order 38293764.docx.pdf'),
(392, 209, '', 'DS615839.pdf'),
(393, 209, '', 'DS615826.pdf'),
(394, 209, '', 'DS615812.pdf'),
(395, 209, '', 'DS615816.pdf'),
(396, 209, '', 'DS615753.pdf'),
(399, 212, '', '192865A-001_01.pdf'),
(400, 213, '', '193000A-001_01.pdf'),
(401, 213, '', '187201A-002_01.pdf'),
(402, 214, '', 'DS615873.pdf'),
(403, 214, '', 'DS615872.pdf'),
(404, 216, '', 'Timesheet 10-10.pdf'),
(405, 224, '', '186855A-003.pdf'),
(406, 225, '', '38282165-002B Shaft, Tubular Female (3).cgm'),
(407, 226, '', '38282165-002B Shaft, Tubular Female (7).cgm'),
(408, 226, '', 'DS 615931 (2).pdf'),
(409, 226, '', '38282165-002B Shaft, Tubular Female (Plated) (1).pdf'),
(410, 227, '', '186855A-003.pdf'),
(411, 227, '', '187201A-002.pdf'),
(412, 227, '', '192542A-001.pdf'),
(413, 227, '', '192174A-002.pdf'),
(414, 229, '', '188879A-002_01.pdf'),
(416, 231, '', '188138.pdf'),
(417, 231, '', '188139.pdf'),
(418, 231, '', '188140.pdf'),
(419, 231, '', '188141.pdf'),
(420, 231, '', '188142.pdf'),
(421, 232, '', '188138.pdf'),
(440, 252, '', 'DS615963 - qty(days).pdf'),
(442, 252, '', 'DS615963.pdf'),
(443, 253, '', 'PO 192971 - alt.pdf'),
(444, 253, '', 'doclibp-02053240-10011.pdf'),
(445, 254, '', 'PO 192612 alt.pdf'),
(446, 255, '', 'PO 192526 alt.pdf'),
(447, 256, '', 'PO 192479 - alt.pdf'),
(448, 257, '', 'PO 191959 - timing.pdf'),
(449, 257, '', 'PO 191959 - alt.pdf'),
(450, 259, '', 'PO 193325 - tech review notes.pdf'),
(451, 259, '', 'PO 193325 - timing.pdf'),
(453, 259, '', '38294669 001AMP3 28OC20 - PULLEY ASM, DRIVEN.pdf'),
(454, 259, '', 'PO 193325 - alt.pdf'),
(455, 252, '', '204185.pdf'),
(456, 262, '', 'PO 192605 - qty.pdf'),
(458, 262, '', 'PO 192605 - alt.pdf'),
(459, 267, '', 'DS615968 Req.pdf'),
(460, 267, '', '38282604 and 38282596 Quote Response.pdf'),
(461, 267, '', '38282604_01AMP Spacer (RH).pdf'),
(462, 267, '', '38282596_02BMP2 Cam Rake.pdf'),
(464, 272, '', 'Target Date Investment Change 11.20.20 EE notice.pdf'),
(465, 272, '', '38296653 001A 08SE20 - BUSHING, MOUNTING.pdf.url'),
(466, 275, '', 'DS615962 - Ranger Pinions.pdf'),
(467, 275, '', '38289863.pdf'),
(468, 275, '', '38289864.pdf'),
(469, 275, '', '38289865.pdf'),
(470, 275, '', '4868 - 55 CF Pinion.pdf'),
(471, 275, '', '4869 - 60 CF Pinion.pdf'),
(472, 275, '', '4867 - 63CF Pinion.pdf'),
(473, 275, '', '38289865_002M Pinion Steering 60Cf.pdf'),
(474, 275, '', '38289863_002M Pinion Steering 55Cf.pdf'),
(475, 275, '', '38289864_002M Pinion Steering 63Cf.pdf'),
(476, 275, '', '34215681_002N Pinion Black Chart, Steering.pdf'),
(477, 275, '', '38298206_001A Pinion Bar Blank, Steering.pdf'),
(478, 276, '', '21546 - 38289865 - Rough Hob.pdf'),
(479, 276, '', '21548 - 38289865 - Finish Grind.pdf'),
(480, 276, '', '21549 - 38289863 - Rough Hob.pdf'),
(481, 276, '', '21551 - 38289863 - Finish Grind.pdf'),
(482, 276, '', '21552 - 38289864 - Rough Hob.pdf'),
(483, 276, '', '21554 - 38289864 - Finish Grind.pdf'),
(484, 276, '', 'DS615970 - Delta Pinions.pdf'),
(485, 276, '', '38289864_002M Pinion Steering 63Cf.pdf'),
(486, 276, '', '38289865_002M Pinion Steering 60Cf.pdf'),
(487, 276, '', '38289863_002M Pinion Steering 55Cf.pdf'),
(488, 276, '', '4868 - 55 CF Pinion.pdf'),
(489, 276, '', '4869 - 60 CF Pinion.pdf'),
(490, 276, '', '4867 - 63CF Pinion.pdf'),
(491, 276, '', '34215681_002N Pinion Black Chart, Steering.pdf'),
(492, 276, '', '38298206_001A Pinion Bar Blank, Steering.pdf'),
(505, 278, '', 'Bell - 0930s.pdf'),
(506, 278, '', 'UI192947 - Price Change 2.pdf'),
(507, 289, '', 'DS615977 - quote.pdf'),
(508, 289, '', 'DS615977.pdf'),
(509, 290, '', 'Target Date Investment Change 11.20.20 EE notice.pdf'),
(510, 290, '', 'UI192947 - Price Change 2.pdf'),
(511, 300, '', '38267884_003A Ring, Interlocking Anti-Rotate.pdf'),
(512, 300, '', '38267912_003A Stop Ring, Interlocking Anti-Rotate.pdf'),
(513, 300, '', '38267913_002A Key, Interlocking Anti-Rotate.pdf'),
(514, 300, '', '38269262.003.x_t'),
(515, 300, '', '38269262_003A Coated Ring, Interlocking Anti-Rotate.pdf'),
(516, 300, '', '38269262_003-COATED RING_ INTERLOCKING ANTI-ROTATE.stp'),
(517, 300, '', '38269265_003.x_t'),
(518, 300, '', '38269265_003A Coated Key, Interlocking Anti-Rotate.pdf'),
(519, 300, '', '38269265_003-COATED KEY_ INTERLOCKING ANTI-ROTATE.stp'),
(520, 300, '', '38269275.003.x_t'),
(521, 300, '', '38269275_003A Coated Stop Ring, Interlocking Anti-Rotate.pdf'),
(522, 300, '', '38269275_003-COATED STOP RING_ INTERLOCKING ANTI-ROTATE.stp'),
(523, 300, '', 'DS615980 Req.pdf'),
(524, 312, '', '38257569H_009C.pdf'),
(525, 312, '', '38257569H_009-DETENT_ LEVER _LEFT.x_t'),
(526, 312, '', '38257569H_009-DETENT_ LEVER _LEFT_.stp'),
(527, 312, '', '38257570H_009C.pdf'),
(528, 312, '', '38257570H_009-DETENT_ LEVER _RIGHT.x_t'),
(529, 312, '', '38257570H_009-DETENT_ LEVER _RIGHT_.stp'),
(530, 312, '', 'DS615973 Req.pdf'),
(531, 312, '', 'P-149-1_38257569H_Detent,_Lever_.docx.pdf'),
(532, 312, '', 'P-149-1_38257570H_Detent,_Lever_.docx.pdf'),
(533, 314, '', 'Quote.pdf'),
(534, 314, '', 'UI191897.pdf'),
(535, 315, '', '38260820.pdf'),
(536, 315, '', '38285818 1AMP2NC 12OC20 - SHAFT, LOWER STRG.pdf'),
(537, 315, '', 'DS615987.pdf'),
(538, 315, '', 'Quote.pdf'),
(571, 331, '', '38265645 003CHART 04NO20 - PULLEY DRIVEN.pdf'),
(572, 331, '', 'DS615991 - Drive Pulleys.pdf'),
(573, 331, '', 'DS615991 - quote.pdf'),
(574, 331, '', 'P-149_for_Geely_Pulleys_30OCT2020.docx.pdf'),
(576, 332, '', 'PO 192864 - alt.pdf'),
(577, 332, '', 'PO 192864 - tooling.pdf'),
(578, 332, '', 'Quotation #29767.pdf'),
(579, 332, '', 'Quotation #29767 (1).pdf'),
(580, 333, '', 'DS615997 - quote.pdf'),
(581, 333, '', 'DS615997.pdf'),
(582, 333, '', '38289862_002AMP-RACK BALL SCREW (63CF).pdf'),
(583, 333, '', 'Router 4866 (63CF).pdf'),
(584, 334, '', 'DS616002.pdf'),
(585, 334, '', 'P-149.pdf'),
(586, 334, '', 'prd_26140702_006_D_01_01_0_101102.pdf'),
(587, 334, '', 'Quote.pdf'),
(588, 347, '', 'DS616011 - quote.pdf'),
(589, 347, '', 'DS616011.pdf'),
(590, 348, '', 'BN 2608.1.pdf'),
(591, 348, '', 'BN2608.1.zip'),
(592, 348, '', 'DS616015 - quote.pdf'),
(593, 348, '', 'DS616015.pdf'),
(594, 348, '', 'DS6156015 - timing.pdf'),
(595, 357, '', 'PO UI192012 Alteration.pdf'),
(598, 359, '', 'doclibp-02055352-8347.pdf'),
(599, 359, '', 'PO 192385 - price alt.pdf'),
(600, 360, '', 'PO 193481 - timing.pdf'),
(601, 360, '', 'PO 193481 - alt.pdf'),
(602, 361, '', 'PO 193147 - alt.pdf'),
(603, 362, '', 'PO 193038 - pricing.pdf'),
(604, 362, '', 'PO 193038 - alt.pdf'),
(605, 363, '', 'PO 193329 - alt.pdf'),
(606, 366, '', 'DS616026 - quote.pdf'),
(607, 366, '', 'DS616026.pdf'),
(608, 366, '', 'DS616026 - timing.pdf'),
(609, 366, '', 'BN 2615.1.pdf'),
(610, 366, '', 'BN_2615.1.zip'),
(611, 368, '', 'DS616027 & DS616028 - quote.pdf'),
(612, 368, '', 'DS616027.pdf'),
(613, 368, '', 'BN 2602.1.pdf'),
(614, 368, '', 'BN 2602.1.zip'),
(615, 369, '', 'DS616027 & DS616028 - quote.pdf'),
(616, 369, '', 'DS616027.pdf'),
(617, 370, '', 'DS616037.pdf'),
(618, 370, '', 'DS616037 - quote.pdf'),
(619, 370, '', '38289860_002A-RACK BALL SCREW (60CF).pdf'),
(620, 370, '', '38289861_002A-RACK BALL SCREW (55CF).pdf'),
(621, 358, '', 'CT.10.00.05  RFQ response for customer_1Revised_LFS_21102.pdf'),
(622, 358, '', 'PO UI192114 Alt.pdf'),
(623, 371, '', 'P-149_(Yoke,_Column).pdf'),
(624, 371, '', 'P-149_(Yoke,_Gear).pdf'),
(625, 372, '', '38293111_001_A_ Shaft, Lower STRG.pdf'),
(626, 372, '', 'P-149_(Shaft,_Inner).pdf'),
(627, 373, '', 'P-149_(Shaft,_Outer).pdf'),
(628, 373, '', '38293113_001_A_Shaft, Tubular Steering.pdf'),
(629, 371, '', 'DS616059.pdf'),
(630, 372, '', 'DS616062.pdf'),
(631, 373, '', 'DS616063.pdf'),
(632, 374, '', '38289864_ID_59983_MU_20201110.pdf'),
(633, 375, '', 'PO 193625 - alt.pdf'),
(634, 376, '', 'doclibp-02056442-8363.pdf'),
(635, 376, '', '192866 - alt.pdf'),
(636, 377, '', 'PO 193084 alt.pdf'),
(637, 378, '', 'BN2608.1_P149_ RU BASE PHA signed.pdf'),
(638, 371, '', '38293037_002-YOKE_ STRG SHAFT CLAMP.stp'),
(639, 371, '', '38293036_002-YOKE_ STRG GEAR CLAMP (1).stp'),
(640, 372, '', '38293111_001-SHAFT_ LOWER STRG.stp'),
(641, 373, '', '38293113_001-SHAFT_ TUBULAR STRG.stp'),
(642, 379, '', 'Sales Quote 377765.pdf'),
(643, 379, '', 'DS616071.pdf'),
(644, 378, '', '193635 - qty.pdf'),
(645, 378, '', 'PO 193635 - alt.pdf'),
(646, 380, '', 'DS616064 - quote.pdf'),
(647, 380, '', 'DS616064.pdf'),
(648, 380, '', 'P-149_(Nut,_Clinch).pdf'),
(663, 374, '', 'DS616069 - timing.pdf'),
(664, 374, '', '224058524.pdf'),
(665, 374, '', 'DS616069.pdf'),
(666, 386, '', 'Gerdau Blanks.pdf'),
(667, 386, '', 'DS616081 - qty available.pdf'),
(668, 386, '', 'DS616081.pdf'),
(669, 386, '', 'DS616081 - quote.pdf'),
(670, 386, '', '38276203 002CMP - RACK BLANK, BALL SCREW.pdf'),
(671, 387, '', 'PO 192897 - pricing.pdf'),
(672, 387, '', 'PO 192897 - alt.pdf'),
(673, 388, '', 'Tie Rod Pricing.pdf'),
(674, 388, '', 'PO 193160 alt.pdf'),
(675, 388, '', '38293763 003AMP 12NO20 - ROD ASM, INNER TIE.pdf'),
(676, 371, '', '38293036_002_A_Yoke, STRG Gear Clamp.pdf'),
(677, 371, '', '38293037_002_A_Yoke, STRG Shaft Clamp.pdf'),
(678, 389, '', 'Tie Rod Pricing.pdf'),
(679, 389, '', 'PO 193165 alt.pdf'),
(680, 390, '', '38279178 001ARW3 11JN20 - SHAFT BEARING.pdf'),
(681, 390, '', 'Purchase Req.pdf'),
(686, 392, '', 'doclibp-02051060-UI193274.pdf'),
(687, 392, '', 'Email Confirming.pdf'),
(688, 392, '', 'UI193274 - Cancel.pdf'),
(689, 393, '', 'P-149-1 - BMW CLAR WE I-S - PROTOTYPE SWIVEL SOCKET BUSHING 38290240-003B -2020OCT15.rtf.pdf'),
(690, 393, '', 'Purchase Req.pdf'),
(691, 393, '', 'Saint Gobain Quote.pdf'),
(692, 394, '', 'Heidis Email.pdf'),
(693, 394, '', 'UI193504.pdf'),
(696, 395, '', 'DS616086.pdf'),
(697, 395, '', 'DS615266 - Quote.pdf'),
(698, 396, '', 'DS616087.pdf'),
(699, 396, '', 'Quote.pdf'),
(700, 397, '', 'DS616088 - quote.pdf'),
(701, 397, '', 'DS616088.pdf'),
(702, 397, '', 'BN 2586.1.pdf'),
(703, 397, '', 'BN 2586.1 -reviewed prints.zip'),
(705, 400, 'requester', 'DS616094 - quote.pdf'),
(706, 400, 'requester', 'DS616094.pdf'),
(707, 400, 'requester', 'BN 2600.1.pdf'),
(708, 400, 'requester', 'BN2600.1 PPE Marked Prints 9.30.zip'),
(709, 401, 'requester', '192550 - alt.pdf'),
(710, 402, 'requester', '192842 - alt.pdf'),
(711, 403, 'requester', '193033 - alt.pdf'),
(712, 404, 'requester', '192794 - alt.pdf'),
(713, 406, 'requester', '193156 - alt.pdf'),
(714, 407, 'requester', '192605 - alt.pdf'),
(715, 408, 'requester', '192397 - alt.pdf'),
(716, 409, 'requester', '193019 - alt.pdf'),
(717, 410, 'requester', '193753 - ship to.pdf'),
(718, 410, 'requester', '193753 - alt.pdf'),
(719, 411, 'requester', 'DS616095.pdf'),
(720, 411, 'requester', 'P149 _ 38206321 T1XX HD Upper Overmolded Shaft 06NO20.docx.pdf'),
(721, 411, 'requester', 'P149 _ 38239719 Coated Koyo Bearings 06NO20.docx.pdf'),
(722, 411, 'requester', 'Quote.pdf'),
(723, 412, 'requester', '192868 - round 2 pricing.pdf'),
(724, 412, 'requester', '192868 - alt.pdf'),
(725, 412, 'requester', 'DS615544 - quote.pdf'),
(726, 413, 'requester', '38257569J_010.pdf'),
(727, 413, 'requester', '38257569J_010-DETENT_ LEVER _LEFT.x_t'),
(728, 413, 'requester', '38257569J_010-DETENT_ LEVER _LEFT_.stp'),
(729, 413, 'requester', '38257570J_009.pdf'),
(730, 413, 'requester', '38257570J_009-DETENT_ LEVER _RIGHT.x_t'),
(731, 413, 'requester', '38257570J_009-DETENT_ LEVER _RIGHT_.stp'),
(732, 413, 'requester', 'DS616107 Req.pdf'),
(733, 413, 'requester', 'P-149-1 38257569J Detent, Lever .docx.pdf'),
(734, 413, 'requester', 'P-149-1 38257570J Detent, Lever .docx.pdf'),
(735, 414, 'requester', '38298275 001A 15OC20 - SHAFT, CLAMP.pdf'),
(736, 414, 'requester', 'DS616100.pdf'),
(737, 414, 'requester', 'P-149-1 - BMW CLAR WE I-S - DV2 CLAMP SHAFT -GEAR - 38298275-001A -2020Nov11.rtf.pdf'),
(738, 414, 'requester', 'Quotation 29829.pdf'),
(741, 417, 'requester', '38280885 004AMP4 18SE20 - BOLT CLAMP PRINT.pdf'),
(742, 417, 'requester', 'Quote.pdf'),
(743, 417, 'requester', 'UI193375.pdf'),
(744, 418, 'requester', '192634 - alt.pdf'),
(745, 418, 'requester', '192634 - qty increase.pdf'),
(746, 419, 'requester', '192634 - qty increase.pdf'),
(747, 419, 'requester', '192634 - alt.pdf'),
(748, 420, 'requester', '192817 - qty increase.pdf'),
(749, 420, 'requester', '192817 - alt.pdf'),
(750, 421, 'requester', '193044 - alt.pdf'),
(751, 421, 'requester', '193044 - qty increase.pdf'),
(752, 422, 'requester', 'DS616116 - quote.pdf'),
(753, 422, 'requester', 'DS616116.pdf'),
(754, 423, 'requester', 'DS616117.pdf'),
(755, 423, 'requester', 'DS615397 quote.pdf'),
(756, 424, 'requester', 'DS615261 - Quote.pdf'),
(757, 424, 'requester', 'DS616118.pdf'),
(758, 425, 'requester', '38266746_5NMOD_Ball nut 17NO20.pdf'),
(759, 425, 'requester', '38266746-005NMOD.pdf'),
(760, 425, 'requester', 'DS616120 Req.pdf'),
(761, 426, 'requester', '193325 - qty increase.pdf'),
(762, 426, 'requester', '193325 - alt.pdf'),
(763, 427, 'requester', 'doclibp-02043514-UI192624.pdf'),
(764, 427, 'requester', 'DS616121 - quote.pdf'),
(765, 427, 'requester', 'DS616121.pdf'),
(766, 428, 'requester', 'DS616126.pdf'),
(767, 428, 'requester', 'DS616126 - quote.pdf'),
(768, 429, 'requester', '193781 - pricing.pdf'),
(769, 429, 'requester', '193781 - alt.pdf'),
(770, 430, 'requester', '193019 - qty increase.pdf'),
(771, 430, 'requester', '193019 alt.pdf'),
(772, 431, 'requester', 'DS616136 - quote.pdf'),
(773, 431, 'requester', 'DS616136.pdf'),
(774, 431, 'requester', '38216204 002E 23JL20 - SEAL, O-RING.pdf'),
(775, 432, 'requester', '38282589_001A Assist Asm.pdf'),
(776, 432, 'requester', 'CT.10.00.05  RFQ response for customer_2Revised_LFS_21102.pdf'),
(777, 432, 'requester', 'DS616090 Req.pdf'),
(778, 434, 'requester', 'DS616139 & DS616140 - quote.pdf'),
(779, 434, 'requester', 'DS616139.pdf'),
(780, 434, 'requester', '38277243 001A 20JN19 - RETAINER, BALL RETURN GUIDE.pdf'),
(781, 435, 'requester', 'DS616139 & DS616140 - quote.pdf'),
(782, 435, 'requester', 'DS616140.pdf'),
(783, 435, 'requester', '38277891 002C 19DE19 - GUIDE, BALL RETURN (LOWER).pdf'),
(784, 435, 'requester', '38277892 002C 19DE19 - GUIDE. BALL RETURN (UPPER).pdf'),
(785, 436, 'requester', 'BN 2625.1.pdf'),
(786, 436, 'requester', 'BN_2625.1.zip'),
(787, 436, 'requester', 'DS616144.pdf'),
(788, 436, 'requester', 'P-149-1 Worksheet For BN 2625.1.pdf'),
(789, 436, 'requester', 'Quote Number AAI20201118 BN2625.1.pdf'),
(790, 437, 'requester', '192385 - pricing.pdf'),
(791, 437, 'requester', '192385 - alt.pdf'),
(792, 438, 'requester', '192683 - qty increase.pdf'),
(793, 438, 'requester', '192683 - alt.pdf'),
(798, 443, 'requester', '192529 - price confirmation.pdf'),
(799, 443, 'requester', '192529 - alt.pdf'),
(800, 443, 'requester', '38286235B 002S 13OC20 - BEARING ASM, BALL NUT &.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(25) NOT NULL,
  `reqs_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `new` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `reqs_id`, `name`, `comment`, `timestamp`, `new`) VALUES
(43, 253, 'Alexandra', 'Changing qty to match what was received ', '2020-11-02 12:14:37', NULL),
(44, 254, 'Alexandra', 'Changing promise date ', '2020-11-02 12:15:10', NULL),
(45, 255, 'Alexandra', 'Changing promise date ', '2020-11-02 12:15:44', NULL),
(46, 256, 'Alexandra', 'Changing promise date ', '2020-11-02 12:16:16', NULL),
(47, 257, 'Alexandra', 'Changing promise date ', '2020-11-02 12:16:38', NULL),
(50, 252, 'Tekela', 'Quantity 1 on the quote, but Req has 3. I need an update quote.', '2020-11-02 12:58:33', NULL),
(51, 259, 'Alexandra', 'Altering PO per tech review ', '2020-11-02 13:25:55', NULL),
(52, 259, 'Kristen', 'wo#', '2020-11-02 13:55:18', NULL),
(56, 252, 'Alexandra', 'Updated quote attached! ', '2020-11-02 15:22:48', NULL),
(60, 262, 'Alexandra', 'Changing qty per supplier standard pack size ', '2020-11-02 16:52:34', NULL),
(61, 262, 'Kristen', 'CHANGE QTY ON THE REQ', '2020-11-02 17:13:40', NULL),
(62, 262, 'Alexandra', 'Updated attached! ', '2020-11-02 17:57:11', NULL),
(76, 272, 'Tekela', 'Comment', '2020-11-02 19:42:37', NULL),
(78, 275, 'Alexandra', 'Please schedule tech review ASAP and w/ DS615970. Also, please pass along to LeRoy to invite David King to this tech review', '2020-11-03 12:13:46', NULL),
(79, 275, 'Tekela', 'Do you have prints?', '2020-11-03 12:18:42', NULL),
(80, 276, 'Alexandra', 'Please schedule tech review w/ DS615962 & this week if possible. We\'re going to be tight on timing ', '2020-11-03 12:19:08', NULL),
(81, 275, 'Alexandra', 'The prints should be attached now. I had to do it at separate times ', '2020-11-03 12:19:56', NULL),
(82, 276, 'Tekela', 'Need prints', '2020-11-03 12:24:49', NULL),
(83, 276, 'Alexandra', 'The prints should be there now too. I had to do it separate again but it\'s the same prints from DS615962', '2020-11-03 12:49:12', NULL),
(84, 275, 'Spencer', 'I\'m really sorry! I\'ll try to look into a workaround for this', '2020-11-03 13:31:18', NULL),
(85, 278, 'Kristen', 'no file attached ', '2020-11-03 13:56:53', NULL),
(86, 278, 'Spencer', 'Made a hotfix for files with single quotes (\') in them. Gavin should be able to reupload', '2020-11-03 14:32:42', NULL),
(87, 297, 'Tekela', 'Is the suppose to flag a HOT!!!! req?', '2020-11-03 16:34:18', NULL),
(88, 300, 'Racquel', 'Wright\'s coating already said they could not do this job anymore. Please do not quote them.', '2020-11-03 16:37:38', NULL),
(89, 300, 'Tekela', 'Wright is the only supplier that has quoted these. This was already sent out for quote and was NQ by all the suppliers. Did Wright give a reason why they don\'t want to do this? If so please forward to me so I can address. ', '2020-11-03 18:00:26', NULL),
(90, 300, 'Tekela', 'I Sent an email to Wright to see what can they do that wont stress their capacity.', '2020-11-04 14:23:15', NULL),
(92, 312, 'Tekela', 'Isn\'t this a production PN?', '2020-11-04 14:48:01', NULL),
(93, 332, 'Alexandra', 'Adding line items for tooling required ', '2020-11-04 15:18:44', NULL),
(94, 332, 'Tekela', 'The quote wont download', '2020-11-04 15:24:51', NULL),
(95, 312, 'Racquel', 'This is not a production PN. I could not find it in PMD or Intelex', '2020-11-04 15:37:55', NULL),
(96, 332, 'Alexandra', 'Does it work now?', '2020-11-04 15:56:51', NULL),
(97, 332, 'Alexandra', 'I emailed you the quote because I can\'t get it to work ', '2020-11-04 16:01:04', NULL),
(98, 312, 'Tekela', 'Waiting to see if you can use the current PN.', '2020-11-04 16:39:59', NULL),
(99, 300, 'Tekela', 'Per our conversation, Waiting on Wright to see what they can do and asking locals for suggestions.', '2020-11-04 16:41:03', NULL),
(100, 312, 'Racquel', 'These have more material in it than the current P/N', '2020-11-04 20:54:44', NULL),
(101, 333, 'Tekela', 'Router wont download', '2020-11-05 16:31:24', NULL),
(102, 312, 'Tekela', 'DUE BACK 11/9', '2020-11-06 12:26:56', NULL),
(103, 348, 'Tekela', 'I NEED THE P149? ALSO, HAVE A TECH REV WITH EVERY ORDER. ', '2020-11-06 14:58:28', NULL),
(104, 348, 'Alexandra', 'The p-149 should be in the zip file. Even though it\'s engineering controlled, we need a tech review?', '2020-11-06 15:21:49', NULL),
(105, 348, 'Tekela', 'I cant access the zipfile and I will push it through but it was a note to have tech reviews with all flex orders. ', '2020-11-06 16:37:14', NULL),
(116, 300, 'Tekela', 'Sent you an email to confirm batch delivery and timing 11/6. ', '2020-11-09 12:21:31', NULL),
(127, 300, 'Tekela', 'Sent an email to Universal waiting no response.', '2020-11-09 16:48:27', 0),
(128, 300, 'Racquel', 'Would you like me to ask Zach for his contacts?', '2020-11-09 18:52:31', 0),
(129, 300, 'Tekela', 'Sorry, I meant waiting on their response. ', '2020-11-09 18:56:01', 0),
(130, 312, 'Tekela', 'I resent for more quotes, only got 2 in', '2020-11-10 13:16:13', 0),
(131, 312, 'Racquel', 'what does timing look like so far?', '2020-11-10 13:25:56', 0),
(132, 358, 'Tekela', 'You have to add a line for Vat tax', '2020-11-10 13:50:08', 0),
(133, 359, 'Alexandra', 'changing price ', '2020-11-10 14:37:29', 0),
(134, 360, 'Alexandra', 'changing promise date ', '2020-11-10 14:38:44', 0),
(135, 361, 'Alexandra', 'changing promise date ', '2020-11-10 14:39:13', 0),
(136, 362, 'Alexandra', 'changing promise date, price & adding in general comment ', '2020-11-10 14:40:00', 0),
(137, 363, 'Alexandra', 'changing promise date ', '2020-11-10 14:40:30', 0),
(138, 366, 'Alexandra', 'Please try to get tech review scheduled this week ', '2020-11-10 14:41:38', 0),
(139, 368, 'Alexandra', 'Please try to have tech review scheduled this week ', '2020-11-10 14:43:20', 0),
(140, 369, 'Alexandra', 'The rest of the tooling for DS616027', '2020-11-10 14:43:56', 0),
(141, 312, 'Tekela', '2-3WKS', '2020-11-10 15:36:13', 0),
(142, 369, 'Tekela', 'you added the wrond pdf', '2020-11-10 15:37:06', 0),
(143, 369, 'Alexandra', 'Can you reject this so I can update it?', '2020-11-10 15:45:00', 0),
(144, 369, 'Tekela', 'I already got the correct one from PORT', '2020-11-10 15:51:36', 0),
(145, 312, 'Racquel', 'Ok the engineer needed these ASAP so we will need the best timing on this part. ', '2020-11-10 17:21:07', 0),
(146, 312, 'Tekela', 'Ok, 2 weeks is the best timing so I will source Micron.', '2020-11-10 18:43:41', 0),
(147, 358, 'Racquel', 'Changed alteration :)', '2020-11-10 19:33:35', 0),
(148, 358, 'Tekela', 'The pdf files are not downloading ', '2020-11-11 12:10:49', 0),
(149, 358, 'Spencer', 'You should be able to download the files now Tekela', '2020-11-11 12:30:33', NULL),
(150, 300, 'Tekela', 'Wright is trying to submit a quote based off their capabilities. I also sent to some inactive suppliers for coating to see if it is something they can do. ', '2020-11-11 14:01:51', 0),
(151, 371, 'Alexandra', 'Please Target Hao Hai ', '2020-11-11 19:36:04', 0),
(152, 372, 'Alexandra', 'Please target Hao Hai', '2020-11-11 19:36:44', 0),
(153, 358, 'Racquel', 'Was this resolved?', '2020-11-11 19:42:44', 0),
(154, 375, 'Alexandra', 'Closing line items', '2020-11-12 12:11:03', 0),
(155, 376, 'Alexandra', 'Changing qty ', '2020-11-12 12:11:36', 0),
(156, 377, 'Alexandra', 'Changing promise date ', '2020-11-12 12:12:21', 0),
(157, 378, 'Alexandra', 'Changing qty ', '2020-11-12 12:13:21', 0),
(158, 378, 'Kristen', 'you only gave me the p-149', '2020-11-12 12:36:29', 0),
(159, 378, 'Alexandra', 'Alt attached! ', '2020-11-12 12:40:00', 0),
(160, 374, 'Kristen', 'I NEED THE DS# AND QUOTE', '2020-11-12 14:04:07', 0),
(162, 373, 'Kristen', 'OUT FOR QUOTE DUE BACK 11/13', '2020-11-12 17:55:51', 0),
(163, 387, 'Alexandra', 'changing qty ', '2020-11-12 18:15:12', 0),
(164, 388, 'Alexandra', 'changing rev & qty ', '2020-11-12 18:21:22', 0),
(165, 371, 'Kristen', 'I need 2d prints, i only have cad', '2020-11-12 18:21:59', 0),
(166, 371, 'Alexandra', 'Prints attached! ', '2020-11-12 18:23:00', 0),
(167, 389, 'Alexandra', 'changing qty ', '2020-11-12 18:23:56', 0),
(168, 372, 'Kristen', 'QUOTES DUE BACK 11/13', '2020-11-12 18:32:13', 0),
(169, 371, 'Kristen', 'QUOTES DUE BACK 11/13', '2020-11-12 18:39:14', 0),
(170, 390, 'Kristen', 'I WILL NOT LET ME DOWNLOAD THE QUOTE PLEASE REATTCH', '2020-11-12 18:52:57', 0),
(171, 358, 'Tekela', 'Sorry, I need the p149', '2020-11-12 19:32:42', 0),
(172, 358, 'Racquel', 'This is a prototype WO# so there isn\'t one for this order', '2020-11-12 19:34:05', 0),
(173, 397, 'Alexandra', 'Please have tech review scheduled asap ', '2020-11-13 13:08:36', 0),
(174, 300, 'Racquel', 'Is there an update on this? Was Wright\'s/Universal able to quote?', '2020-11-13 14:15:07', 0),
(175, 300, 'Tekela', 'I haven\'t got nothing back yet, I will follow up today!', '2020-11-13 15:59:04', 0),
(176, 368, 'Tekela', 'NEED P149', '2020-11-13 19:09:53', 0),
(177, 368, 'Alexandra', 'Why do we need a P149 for this?', '2020-11-13 19:24:06', 0),
(178, 300, 'Tekela', 'NO response from Wright yet, but sent Threebond the spec and prints to review. ', '2020-11-13 19:29:58', 0),
(179, 300, 'Tekela', 'Wright really needs rate and flow to determine what they can do? Do you have an idea yet?', '2020-11-13 19:33:05', 0),
(180, 368, 'Tekela', 'disregard\r\n', '2020-11-13 19:35:04', 0),
(181, 401, 'Alexandra', 'changing promise date ', '2020-11-16 12:13:27', 0),
(182, 402, 'Alexandra', 'changing promise date ', '2020-11-16 12:13:45', 0),
(183, 403, 'Alexandra', 'changing promise date ', '2020-11-16 12:16:34', 0),
(184, 404, 'Alexandra', 'changing promise date ', '2020-11-16 12:17:00', 0),
(185, 406, 'Alexandra', 'changing promise date ', '2020-11-16 12:19:47', 0),
(186, 407, 'Alexandra', 'changing promise date ', '2020-11-16 12:20:31', 0),
(187, 408, 'Alexandra', 'changing promise date ', '2020-11-16 12:20:58', 0),
(188, 409, 'Alexandra', 'changing promise date ', '2020-11-16 12:21:18', 0),
(189, 410, 'Alexandra', 'adding general comment ', '2020-11-16 12:38:08', 0),
(190, 411, 'Gavin', 'There will be an additional line item added to this req once I receive a quote from Plant 61.', '2020-11-16 12:43:51', 0),
(191, 411, 'Tekela', 'So do you want to wait for the quote? Or issue now and do an alteration?', '2020-11-16 12:56:01', 0),
(192, 300, 'Tekela', 'Any update on the rate and flow?', '2020-11-16 12:59:37', 0),
(193, 300, 'Racquel', 'I haven\'t heard anything back yet I will ask Patty again', '2020-11-16 13:36:01', 0),
(194, 373, 'Kristen', 'sourced DPO delivery date 12/07', '2020-11-16 13:40:35', 1),
(195, 372, 'Kristen', 'SOURCED TO RANGER DELIVERY 12/07', '2020-11-16 13:50:02', 1),
(196, 369, 'Tekela', 'Sourced prior to TR', '2020-11-16 13:51:10', 1),
(197, 368, 'Tekela', 'Sourced prior to TR.', '2020-11-16 13:51:31', 1),
(198, 371, 'Kristen', 'SOURCED RANGER/ PRINTS HAVE BEEN MARKED UP ', '2020-11-16 14:56:01', 1),
(199, 300, 'Racquel', 'P/N\'s 38269275 & 38269265 20pcs per P/N per week starting Jan 15th. For P/N 38269262 it is 60pcs per week starting Jan 15th also', '2020-11-16 15:05:51', 0),
(200, 412, 'Alexandra', 'Adding line items', '2020-11-16 16:12:51', 0),
(201, 414, 'Kristen', 'DID U WANT A TECH REVIEW? ', '2020-11-16 18:20:22', 1),
(202, 418, 'Alexandra', 'Changing quantity ', '2020-11-17 13:05:48', 0),
(203, 419, 'Alexandra', 'Changing qty ', '2020-11-17 13:23:43', 0),
(204, 420, 'Alexandra', 'Changing qty ', '2020-11-17 13:56:01', 0),
(205, 421, 'Alexandra', 'changing qty ', '2020-11-17 13:57:49', 0),
(206, 426, 'Alexandra', 'Changing Qty ', '2020-11-17 15:07:43', 0),
(207, 413, 'Kristen', 'sourced micron best timing 3 wk lead time', '2020-11-17 20:20:14', 0),
(208, 429, 'Alexandra', 'Changing qty ', '2020-11-18 13:16:36', 1),
(209, 430, 'Alexandra', 'changing qty ', '2020-11-18 13:20:52', 0),
(210, 300, 'Racquel', 'Did universal NQ? Also please let me know what wright\'s said about rate & flow. We would like to get this taken care of this week. Thanks!', '2020-11-18 15:27:30', 0),
(211, 300, 'Tekela', 'Still waiting on response from Universal. Sent follow up to Wright this morning. ', '2020-11-18 16:54:13', 0),
(212, 432, 'Racquel', 'Nexteer Saginaw will be providing a part & it is available for shipment at any time', '2020-11-18 17:17:08', 0),
(213, 437, 'Alexandra', 'Changing qty, price, & adding line item ', '2020-11-19 12:15:28', 0),
(214, 300, 'Tekela', 'Wright plans to submit quote by noon.', '2020-11-19 15:46:34', 0),
(215, 438, 'Alexandra', 'changing qty ', '2020-11-19 16:28:37', 0),
(216, 300, 'Tekela', 'Sent you the quote in an email.', '2020-11-19 17:51:44', 0),
(217, 443, 'Alexandra', 'changing part number & promise date ', '2020-11-20 13:34:07', 0),
(218, 300, 'Racquel', 'Prints were marked up but it looks like Wright\'s needs to update their quote again since they quoted rev 002 instead of rev 003', '2020-11-20 13:42:29', 0),
(219, 443, 'Kristen', 'waiting on a bearing statement ', '2020-11-20 13:46:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reqs`
--

CREATE TABLE `reqs` (
  `id` int(11) NOT NULL,
  `program` varchar(25) NOT NULL,
  `ds` int(10) NOT NULL,
  `urgency` varchar(1) DEFAULT NULL,
  `progress` varchar(255) NOT NULL DEFAULT 'Submitted',
  `type` varchar(55) NOT NULL,
  `submit_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `submitted` varchar(255) NOT NULL,
  `assigned` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reqs`
--

INSERT INTO `reqs` (`id`, `program`, `ds`, `urgency`, `progress`, `type`, `submit_date`, `due_date`, `date`, `submitted`, `assigned`) VALUES
(130, 'N/A', 615638, 'N', 'Done', 'Single Source', '0000-00-00', NULL, '2020-10-20 15:41:44', 'Alexandra', 'Tekela'),
(132, 'N/A', 615643, 'N', 'Done', 'Single Source', '0000-00-00', NULL, '2020-10-20 15:41:53', 'Alexandra', 'Tekela'),
(133, 'N/A', 615644, 'N', 'Done', 'Single Source', '0000-00-00', NULL, '2020-10-20 15:42:00', 'Alexandra', 'Tekela'),
(252, 'Nissan', 615963, 'N', 'Done', 'Single Source', '0000-00-00', NULL, '2020-11-02 16:42:06', 'Alexandra', 'Tekela'),
(253, 'Nissan', 192971, 'N', 'Done', 'Alterations', '0000-00-00', NULL, '2020-11-02 16:42:12', 'Alexandra', 'Kristen'),
(254, 'Nissan', 192612, 'N', 'Done', 'Alterations', '0000-00-00', NULL, '2020-11-02 16:42:18', 'Alexandra', 'Kristen'),
(255, 'Nissan', 192526, 'N', 'Done', 'Alterations', '0000-00-00', NULL, '2020-11-02 16:42:25', 'Alexandra', 'Kristen'),
(256, 'Nissan', 192479, 'N', 'Done', 'Alterations', '0000-00-00', NULL, '2020-11-02 16:42:32', 'Alexandra', 'Kristen'),
(257, 'Nissan', 191959, 'N', 'Done', 'Alterations', '0000-00-00', NULL, '2020-11-03 16:42:40', 'Alexandra', 'Kristen'),
(259, 'Nissan', 193325, 'N', 'Done', 'Alterations', '0000-00-00', NULL, '2020-11-03 16:42:46', 'Alexandra', 'Kristen'),
(262, 'Nissan', 192605, 'N', 'Done', 'Alterations', '0000-00-00', NULL, '2020-11-03 16:42:53', 'Alexandra', 'Kristen'),
(267, 'FCA 358', 615968, 'N', 'Done', 'Single Source', '0000-00-00', NULL, '2020-11-03 16:42:59', 'Racquel', 'Kristen'),
(275, 'FCA DT MCA', 615962, 'N', 'Done', 'LTA', '2020-11-03', NULL, '2020-11-11 14:57:09', 'Alexandra', 'Tekela'),
(276, 'FCA DT MCA', 615970, 'N', 'Done', 'Single Source', '2020-11-03', NULL, '2020-11-11 14:56:54', 'Alexandra', 'Tekela'),
(278, 'BMW I-Shaft', 192947, 'N', 'Done', 'Alterations', '2020-11-03', NULL, '2020-11-03 16:43:26', 'Gavin', 'Kristen'),
(289, 'FCA DT MCA', 615977, 'N', 'Done', 'Single Source', '2020-11-03', NULL, '2020-11-03 16:54:34', 'Alexandra', 'Tekela'),
(300, 'GM SWEM', 615980, 'N', 'Done', 'Open Quote', '2020-11-03', NULL, '2020-11-20 17:44:19', 'Racquel', 'Tekela'),
(312, 'Fiat 332', 615973, 'N', 'Done', 'Open Quote', '2020-11-03', NULL, '2020-11-10 18:47:24', 'Racquel', 'Tekela'),
(314, 'BMW I-Shaft', 191897, 'N', 'Done', 'Alterations', '2020-11-04', NULL, '2020-11-04 14:53:16', 'Gavin', 'Tekela'),
(315, 'BMW I-Shaft', 615987, 'N', 'Done', 'Single Source', '2020-11-04', NULL, '2020-11-04 15:18:15', 'Gavin', 'Kristen'),
(331, 'Geely ', 615991, 'N', 'Done', 'Single Source', '2020-11-04', NULL, '2020-11-04 15:22:32', 'Alexandra', 'Kristen'),
(332, 'Nissan', 192864, 'N', 'Done', 'Alterations', '2020-11-04', NULL, '2020-11-04 16:28:55', 'Alexandra', 'Tekela'),
(333, 'FCA DT MCA', 615997, 'N', 'Done', 'LTA', '2020-11-04', NULL, '2020-11-05 17:27:57', 'Alexandra', 'Tekela'),
(334, 'BMW I-Shaft', 616002, 'N', 'Done', 'Single Source', '2020-11-05', NULL, '2020-11-05 16:39:37', 'Gavin', 'Tekela'),
(347, 'FCA DT MCA', 616011, 'N', 'Done', 'Single Source', '2020-11-05', NULL, '2020-11-06 12:40:33', 'Alexandra', 'Tekela'),
(348, ' Chrysler RU', 616015, 'N', 'Done', 'Single Source', '2020-11-06', NULL, '2020-11-06 17:05:16', 'Alexandra', 'Tekela'),
(357, 'GM SWEM', 192012, 'N', 'Done', 'Alterations', '2020-11-09', NULL, '2020-11-09 20:03:06', 'Racquel', 'Kristen'),
(358, 'FCA 358', 192114, 'N', 'Done', 'Alterations', '2020-11-10', NULL, '2020-11-12 19:35:59', 'Racquel', 'Tekela'),
(359, 'Nissan', 192385, 'N', 'Done', 'Alterations', '2020-11-10', NULL, '2020-11-10 15:19:16', 'Alexandra', 'Kristen'),
(360, 'FCA DT MCA', 193481, 'N', 'Done', 'Alterations', '2020-11-10', NULL, '2020-11-10 15:24:01', 'Alexandra', 'Kristen'),
(361, 'FCA DT MCA', 193147, 'N', 'Done', 'Alterations', '2020-11-10', NULL, '2020-11-10 15:26:03', 'Alexandra', 'Kristen'),
(362, 'FCA DT MCA', 193038, 'N', 'Done', 'Alterations', '2020-11-10', NULL, '2020-11-10 15:28:26', 'Alexandra', 'Tekela'),
(363, 'FCA DT MCA', 193329, 'N', 'Done', 'Alterations', '2020-11-10', NULL, '2020-11-10 15:27:48', 'Alexandra', 'Kristen'),
(366, 'FCA DT MCA', 616026, 'Y', 'Done', 'Single Source', '2020-11-10', NULL, '2020-11-12 19:29:25', 'Alexandra', 'Tekela'),
(368, 'FCA DT MCA', 616027, 'N', 'Done', 'Single Source', '2020-11-10', NULL, '2020-11-16 13:51:31', 'Alexandra', 'Tekela'),
(369, 'FCA DT MCA', 616028, 'N', 'Done', 'Single Source', '2020-11-10', NULL, '2020-11-16 13:51:10', 'Alexandra', 'Tekela'),
(370, 'FCA DT MCA', 616037, 'N', 'Done', 'Single Source', '2020-11-10', NULL, '2020-11-10 16:37:29', 'Alexandra', 'Tekela'),
(371, 'Daimler Pursuit', 616059, 'N', 'Done', 'Open Quote', '2020-11-11', '2020-11-13', '2020-11-16 14:56:01', 'Alexandra', 'Kristen'),
(372, 'Daimler Pursuit', 616062, 'N', 'Done', 'Open Quote', '2020-11-11', '2020-11-13', '2020-11-16 13:50:02', 'Alexandra', 'Kristen'),
(373, 'Daimler Pursuit', 616063, 'N', 'Done', 'Open Quote', '2020-11-11', '2020-11-13', '2020-11-16 13:40:50', 'Alexandra', 'Kristen'),
(374, 'FCA DT MCA', 616069, 'Y', 'Done', 'Single Source', '2020-11-12', NULL, '2020-11-12 17:52:19', 'Alexandra', 'Kristen'),
(375, 'FCA DT MCA', 193625, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 12:49:39', 'Alexandra', 'Kristen'),
(376, 'Nissan', 192866, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 12:41:51', 'Alexandra', 'Kristen'),
(377, 'FCA DT MCA', 193084, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 12:38:01', 'Alexandra', 'Kristen'),
(378, ' Chrysler RU', 193635, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 14:03:22', 'Alexandra', 'Kristen'),
(379, 'Nissan', 616071, 'Y', 'Done', 'Single Source', '2020-11-12', NULL, '2020-11-12 14:01:03', 'Alexandra', 'Kristen'),
(380, 'Daimler Pursuit', 616064, 'N', 'Done', 'Single Source', '2020-11-12', NULL, '2020-11-12 14:07:58', 'Alexandra', 'Kristen'),
(386, 'Nissan', 616081, 'N', 'Done', 'Single Source', '2020-11-12', NULL, '2020-11-12 18:01:51', 'Alexandra', 'Kristen'),
(387, 'Nissan', 192897, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 18:46:50', 'Alexandra', 'Kristen'),
(388, 'Nissan', 193160, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 18:48:55', 'Alexandra', 'Kristen'),
(389, 'Nissan', 193165, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 18:50:42', 'Alexandra', 'Kristen'),
(390, 'BMW I-Shaft', 616066, 'N', 'Done', 'Single Source', '2020-11-12', NULL, '2020-11-12 19:04:50', 'Gavin', 'Kristen'),
(392, 'BMW I-Shaft', 193274, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 18:54:54', 'Gavin', 'Kristen'),
(393, 'BMW I-Shaft', 616068, 'N', 'Done', 'Single Source', '2020-11-12', NULL, '2020-11-12 19:03:05', 'Gavin', 'Kristen'),
(394, 'BMW I-Shaft', 193504, 'N', 'Done', 'Alterations', '2020-11-12', NULL, '2020-11-12 18:59:15', 'Gavin', 'Kristen'),
(395, 'Nissan', 616086, 'N', 'Done', 'Single Source', '2020-11-12', NULL, '2020-11-12 20:17:18', 'Alexandra', 'Tekela'),
(396, 'BEV 3', 616087, 'N', 'Done', 'Single Source', '2020-11-13', NULL, '2020-11-13 14:52:53', 'Gavin', 'Kristen'),
(397, 'Nissan', 616088, 'N', 'Done', 'Single Source', '2020-11-13', NULL, '2020-11-20 13:03:47', 'Alexandra', 'Kristen'),
(400, 'Nissan', 616094, 'N', 'Done', 'Single Source', '2020-11-13', NULL, '2020-11-20 13:08:28', 'Alexandra', 'Kristen'),
(401, 'Nissan', 192550, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:47:14', 'Alexandra', 'Tekela'),
(402, 'Nissan', 192842, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:49:05', 'Alexandra', 'Tekela'),
(403, 'Nissan', 193033, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:50:21', 'Alexandra', 'Tekela'),
(404, 'Nissan', 192794, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:51:23', 'Alexandra', 'Tekela'),
(406, '31XX', 193156, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:54:01', 'Alexandra', 'Tekela'),
(407, 'Nissan', 192605, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:51:54', 'Alexandra', 'Kristen'),
(408, 'Nissan', 192397, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:50:37', 'Alexandra', 'Kristen'),
(409, 'Nissan', 193019, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:46:19', 'Alexandra', 'Kristen'),
(410, 'FCA DT MCA', 193753, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 12:43:38', 'Alexandra', 'Kristen'),
(411, 'BT1XX', 616095, 'Y', 'Done', 'Single Source', '2020-11-16', NULL, '2020-11-16 13:13:55', 'Gavin', 'Tekela'),
(412, 'Nissan', 192868, 'N', 'Done', 'Alterations', '2020-11-16', NULL, '2020-11-16 16:53:37', 'Alexandra', 'Kristen'),
(413, 'Fiat 332', 616107, 'N', 'Done', 'Open Quote', '2020-11-16', '2020-11-17', '2020-11-17 20:20:14', 'Racquel', 'Kristen'),
(414, 'BMW I-Shaft', 616100, 'N', 'Done', 'Single Source', '2020-11-16', NULL, '2020-11-16 18:20:22', 'Gavin', 'Kristen'),
(417, 'BEV 3', 193375, 'N', 'Done', 'Alterations', '2020-11-17', NULL, '2020-11-17 13:12:38', 'Gavin', 'Kristen'),
(418, 'Nissan', 192634, 'N', 'Done', 'Alterations', '2020-11-17', NULL, '2020-11-17 13:14:35', 'Alexandra', 'Kristen'),
(419, 'Nissan', 192634, 'N', 'Done', 'Alterations', '2020-11-17', NULL, '2020-11-17 13:45:57', 'Alexandra', 'Kristen'),
(420, 'Nissan', 192817, 'N', 'Done', 'Alterations', '2020-11-17', NULL, '2020-11-17 14:15:15', 'Alexandra', 'Kristen'),
(421, 'Nissan', 193044, 'N', 'Done', 'Alterations', '2020-11-17', NULL, '2020-11-17 14:17:26', 'Alexandra', 'Kristen'),
(422, 'Nissan', 616116, 'N', 'Done', 'Single Source', '2020-11-17', NULL, '2020-11-17 14:25:54', 'Alexandra', 'Kristen'),
(423, 'Nissan', 616117, 'N', 'Done', 'Single Source', '2020-11-17', NULL, '2020-11-17 19:29:57', 'Alexandra', 'Kristen'),
(424, 'Nissan', 616118, 'N', 'Done', 'Single Source', '2020-11-17', NULL, '2020-11-17 14:48:41', 'Alexandra', 'Kristen'),
(425, 'BT1XX', 616120, 'N', 'Done', 'Single Source', '2020-11-17', NULL, '2020-11-18 18:40:12', 'Racquel', 'Tekela'),
(426, 'Nissan', 193325, 'N', 'Done', 'Alterations', '2020-11-17', NULL, '2020-11-17 15:24:08', 'Alexandra', 'Tekela'),
(427, 'Nissan', 616121, 'N', 'Done', 'Single Source', '2020-11-17', NULL, '2020-11-17 15:44:04', 'Alexandra', 'Tekela'),
(428, 'Nissan', 616126, 'N', 'Done', 'Single Source', '2020-11-17', NULL, '2020-11-17 19:33:41', 'Alexandra', 'Kristen'),
(429, 'FCA DT MCA', 193781, 'N', 'Done', 'Alterations', '2020-11-18', NULL, '2020-11-18 15:12:37', 'Alexandra', 'Kristen'),
(430, 'Nissan', 193019, 'N', 'Done', 'Alterations', '2020-11-18', NULL, '2020-11-18 13:41:16', 'Alexandra', 'Tekela'),
(431, 'Nissan', 616136, 'N', 'Done', 'Single Source', '2020-11-18', NULL, '2020-11-18 16:46:37', 'Alexandra', 'Tekela'),
(432, 'FCA 358', 616090, 'N', 'Done', 'Single Source', '2020-11-18', NULL, '2020-11-18 18:52:12', 'Racquel', 'Kristen'),
(434, 'Nissan', 616139, 'N', 'Done', 'Single Source', '2020-11-18', NULL, '2020-11-18 20:35:13', 'Alexandra', 'Tekela'),
(435, 'Nissan', 616140, 'N', 'Done', 'Single Source', '2020-11-18', NULL, '2020-11-18 20:40:41', 'Alexandra', 'Tekela'),
(436, 'FCA DT 5051', 616144, 'N', 'Done', 'Single Source', '2020-11-19', NULL, '2020-11-19 12:34:47', 'Alexandra', 'Kristen'),
(437, 'Nissan', 192385, 'N', 'Done', 'Alterations', '2020-11-19', NULL, '2020-11-19 12:28:54', 'Alexandra', 'Kristen'),
(438, 'Nissan', 192683, 'N', 'Done', 'Alterations', '2020-11-19', NULL, '2020-11-19 16:51:43', 'Alexandra', 'Kristen'),
(443, 'Nissan', 192529, 'N', 'In-Progress', 'Alterations', '2020-11-20', NULL, '2020-11-20 13:40:31', 'Alexandra', 'Kristen');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `password`, `role`) VALUES
(1, 'Spencer', 'Huebler-Davis', 'Skarlifts5*5', 'admin'),
(3, 'Alexandra', 'Koboldt', 'Nexteer!2020', 'requester'),
(4, 'Tekela', 'Alexander', 'Tekela', 'buyer'),
(5, 'Kristen', 'Owczarzak', 'Kristen', 'buyer'),
(6, 'Gavin', 'Greer', 'Gavin', 'requester'),
(8, 'Racquel', 'Royal', 'Racquel', 'requester'),
(11, 'Timothy', 'Spann', 'Timothy', 'admin'),
(14, 'David', 'Erkfritz', 'David', 'admin'),
(15, 'Chris', 'Whitford', 'Chris', 'viewer'),
(16, 'Melissa', 'Kaleyta', 'Melissa', 'viewer'),
(19, 'Jonathan', 'Bartosiewicz', 'Jonathan', 'requester');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reqs`
--
ALTER TABLE `reqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=816;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `reqs`
--
ALTER TABLE `reqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
