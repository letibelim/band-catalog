import {Component} from '@angular/core';
import {BandService} from "../../services/band.service";

@Component({
  selector: 'app-importer',
  templateUrl: './importer.component.html',
  styleUrls: ['./importer.component.scss']
})
export class ImporterComponent {
  acceptedFileType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  defaultMessage = 'Select Xlsx File'
  file: File | null = null;
  feedback: string | null = null;

  constructor(private bandService: BandService) {
  }

  onFileSelected(event: Event): void {

    this.resetFeedback();
    const target = <HTMLInputElement>event.target
    if (target.files && target.files.length > 0) {

      if (target.files[0].type != this.acceptedFileType) {
        this.setFeedBack("Le fichier n'est pas du bon type, il faut un fichier .xlsx");
      } else {
        this.file = target.files[0];
      }
    }
  }

  sendFile(): void {

    if (!this.file) {
      this.setFeedBack('Pas de fichier sélectionné');
      return;
    }
    this.bandService.sendXlsxFile(this.file).subscribe({
        next: () => this.setFeedBack('Le fichier a été envoyé avec succès !'),
      }
    )

  }

  setFeedBack(message: string): void {
    this.feedback = message;
  }

  resetFeedback(): void {
    this.feedback = null;
  }
}
