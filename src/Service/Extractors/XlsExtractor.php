<?php


namespace App\Service\Extractors;


use App\Entity\Album;
use App\Entity\CollectionInterface;
use App\Entity\Compilation;
use App\Entity\File;
use App\Entity\Playlist;
use App\Service\DurationConverter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class XlsExtractor
 * @package App\Service\Extractors
 */
class XlsExtractor extends AbstractExtractor
{
    use DurationConverter;

    /**
     * @var string
     */
    protected $format = 'XLS';


    /**
     * @param array $criteria
     * @return bool
     */
    public function doesHandle(array $criteria): bool
    {
        return !empty($criteria['xls']);
    }


    /**
     * @param Playlist $playlist
     * @param File $file
     * @return mixed|void
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function extractFromPlaylist(Playlist $playlist, File $file)
    {
        $file->setName('Playlist_'.$playlist->getTitle());
        $file->setPath('public/extract/xls/playlist/'.$file->getName().'.xls');

        $this->makeXls($playlist, $file);
    }

    /**
     * @param Album $album
     * @param File $file
     * @return mixed|void
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function extractFromAlbum(Album $album, File $file)
    {
        $file->setName('Album_'.$album->getTitle());
        $file->setPath('public/extract/xls/album/'.$file->getName().'.xls');

        $this->makeXls($album, $file);

    }

    /**
     * @param Compilation $compilation
     * @param File $file
     * @return mixed|void
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function extractFromCompilation(Compilation $compilation, File $file)
    {
        $file->setName('Compilation_'.$compilation->getTitle());
        $file->setPath('public/extract/xls/compilation/'.$file->getName().'.xls');

        $this->makeXls($compilation, $file);
    }


    /**
     * @param CollectionInterface $collection
     * @param File $file
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws Exception
     * @throws \Exception
     */
    public function makeXls(CollectionInterface $collection, File $file)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        switch (true) {
            case $collection instanceof Album:
                $name = 'album';
                break;
            case $collection instanceof Compilation:
                $name = 'compilation';
                break;
            case $collection instanceof Playlist:
                $name = 'playlist';
                break;
        }

        $x = 0;

        switch ($name) {
            case 'album':
                $sheet->setCellValue('D1', 'Artiste')
                    ->setCellValue('D2', $collection->getArtist()->getName())
                    ->setCellValue('D4', 'Durée');
                $sheet->getColumnDimension('D')->setWidth(20);

                foreach ($collection->getTracks() as $track) {
                    $sheet->setCellValue('B'.(5+$x), $track->getId());
                    $sheet->setCellValue('C'.(5+$x), $track->getTitle());
                    $sheet->setCellValue('D'.(5+$x), $this->convertSecondsToDuration($track->getDuration()));
                    $x++;
                }
                break;
            case 'playlist':
                $sheet
                    ->setCellValue('D4', 'Artiste')
                    ->setCellValue('E4', 'Durée');
                $sheet->getColumnDimension('D')->setWidth(20);

                foreach ($collection->getPlaylistTracks() as $playlistTrack) {
                    $sheet->setCellValue('B'.(5+$x), $playlistTrack->getTrack()->getId());
                    $sheet->setCellValue('C'.(5+$x), $playlistTrack->getTrack()->getTitle());
                    $sheet->setCellValue('D'.(5+$x), $playlistTrack->getTrack()->getArtist()->getName());
                    $sheet->setCellValue('E'.(5+$x), $this->convertSecondsToDuration($playlistTrack->getTrack()->getDuration()));
                    $x++;
                }
                break;
            default:
                $sheet
                    ->setCellValue('D4', 'Artiste')
                    ->setCellValue('E4', 'Durée');

                foreach ($collection->getTracks() as $track) {
                    $sheet->setCellValue('B'.(5+$x), $track->getId());
                    $sheet->setCellValue('C'.(5+$x), $track->getTitle());
                    $sheet->setCellValue('D'.(5+$x), $track->getArtist()->getName());
                    $sheet->setCellValue('E'.(5+$x), $this->convertSecondsToDuration($track->getDuration()));
                    $x++;
                }
        }


        $z = 5 + --$x;

        $alignement = new Alignment();

        $sheet->setCellValue('A1', ucfirst($name))
            ->setCellValue('B1', 'N°')
            ->setCellValue('C1', 'Titre')
            ->setCellValue('B2', $collection->getId())
            ->setCellValue('C2', $collection->getTitle())
            ->setCellValue('A4', 'Pistes');


        $sheet->setCellValue('B4', 'N°')
            ->setCellValue('C4', 'Titre');


        $alignement->setHorizontal('left')->setVertical('left');


        $sheet->setCellValue('B1', $collection->getId());

        $sheet->getStyle('A1:D1')->getAlignment()->applyFromArray(
            [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ]
        );
        $sheet->getStyle('A4:E4')->getAlignment()->applyFromArray(
            [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ]
        );
        $sheet->getStyle('A5:D'.$z)->getAlignment()->applyFromArray(
            [
                'horizontal'   => $alignement->getHorizontal(),
                'vertical'     => $alignement->getVertical(),
            ]
        );

        $sheet->getColumnDimension('C')->setWidth(40);
        $sheet->getColumnDimension('E')->setWidth(20);

        $writer = new Xlsx($spreadsheet);
        $writer->save('public/extract/xls/'.$name.'/'.$file->getName().'.xls');
    }


}