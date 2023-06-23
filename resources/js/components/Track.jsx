import React from "react"

export default function Track({ track }) {
//   function handlePlay() {
//     chooseTrack(track.uri)
//   }

  return (
    <div className="container-md text-center playlist">

      <div class="container-fluid p-0 m-0 row song">
          <div class="col-10 m-0">
              <div class="song-title">
                {track.title}
              </div>
              <div class="song-artist">
                  {track.artist}
              </div>

          </div>
          <div class="col-2 m-0">
              X
          </div>
      </div>
    </div>

  )
}