import React from "react"

export default function Track({ track }) {
//   function handlePlay() {
//     chooseTrack(track.uri)
//   }

  return (
        <div className="col-auto border border-primary rounded-pill m-1 row">
          <span className="song-title">{track.title}</span>
          <span className="song-artist">{track.artist}</span>
          <span className="song-delete">X</span>
        </div>
  )
}