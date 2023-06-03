<?php

namespace App\Jobs;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Filler\FillerIdFilter;
use App\Filters\FormFieldAnswer\FormFieldAnswerFormIdFillerIdFilter;
use App\Notifications\Front\AnswerNotification;
use App\Repositories\FillerRepository;
use App\Repositories\FormFieldAnswerRepository;
use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class AnswerNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FormUpdateData $form;
    private FillerUpdateData $filler;
    private FillerRepository $fillerRepository;
    private FormFieldAnswerRepository $formFieldAnswerRepository;

    public function __construct(
        FormUpdateData $form,
        FillerUpdateData $filler
    )
    {
        $this->form = $form;
        $this->filler = $filler;
        $this->fillerRepository = app(FillerRepository::class);
        $this->formFieldAnswerRepository = app(FormFieldAnswerRepository::class);
    }

    public function handle(): void
    {
        config(['organization_id' => $this->form->getOrganizationId()]);

        $filler = $this->fillerRepository->getNotifiableInstance(new FillerIdFilter($this->filler->getId()));

        $file = $this->putFileToStorageAndGetPath();

        $filler->notify(new AnswerNotification($this->filler, $this->form, storage_path('app/'.$file)));
    }

    private function putFileToStorageAndGetPath(): string
    {
        $organizationId = $this->form->getOrganizationId();
        $formId = $this->form->getId();
        $fileName = 'fomulario-' . $formId . '-preenchido-por-' . $this->filler->getName() . '.pdf';

        $path  = "public/$organizationId/forms/$formId/$fileName";

        $pdf = $this->getPdfInstance();
        $pdf->loadView('pdf.form-filled', $this->getData());

        Storage::put($path, $pdf->download("$fileName")->getOriginalContent());

        return $path;
    }

    private function getData(): array
    {
        $answers = $this->formFieldAnswerRepository->getAnswersBy(
            new FormFieldAnswerFormIdFillerIdFilter(
                $this->form->getId(),
                $this->filler->getId()
            )
        );

        return [
            'filler' => $this->filler,
            'form' => $this->form,
            'answers' => $answers
        ];
    }

    private function getPdfInstance(): PDF
    {
        return app(PDF::class);
    }
}