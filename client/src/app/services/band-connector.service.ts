import {Injectable} from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from "@angular/common/http";
import {environment} from '../../environments/environment';
import {BehaviorSubject, catchError, map, Observable, tap, throwError} from 'rxjs';
import {Band} from "../../interfaces/band";

@Injectable({
  providedIn: 'root'
})
export class BandConnectorService {

  private bandsUrl = environment.apiUrl + '/bands'
  private _importUrl = environment.apiUrl + '/imports'

  private bandsSubject = new BehaviorSubject<Band[]>([])
  public bands = this.bandsSubject.asObservable();

  constructor(private http: HttpClient) {
  }

  getAllBands() {
    this.http.get<Band[]>(this.bandsUrl,).pipe(
      catchError(() => {
        this.bandsSubject.error('Impossible de charger le catalogue');
        return [];
      }),
      map((bands) => {
        return bands
      })
    )
      .subscribe((bands) => {
        this.bandsSubject.next(bands);
      });
  }

  sendXlsxFile(file: File): Observable<any> {
    const formData: FormData = new FormData();
    formData.append('file', file);
    return this.http.post(this._importUrl, formData).pipe(
      tap(_ => this.getAllBands()),
      catchError(this.handleError)
    );
  }

  patchBand(band: Band) {
    let headers = new HttpHeaders();
    headers = headers.set('Content-Type', 'application/merge-patch+json');
    console.log(headers);
    this.http.patch(`${this.bandsUrl}/${band.id}`, band, {headers: headers}).pipe(
      catchError(this.handleError),
    ).subscribe({
      next: (band) => this.getAllBands()
    })
  }

  private handleError(error: HttpErrorResponse) {
    if (error.status === 0) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.error);
    } else {
      console.error(`Backend returned code ${error.status}, body was: `, error.error);
    }
    // Return an observable with a user-facing error message.
    return throwError(() => new Error("Désolé, cela n'a pas marché !"));
  }
}
