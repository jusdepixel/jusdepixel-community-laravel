import React from "react";

import './background.scss'

export default class Background extends React.Component {
  render() {
    return (
      <div className={"background-bg"}>
        <div className={`background`}>
          {[...new Array(40)].map((_, i) => (
            <span key={`span-${i}`} />
          ))}
        </div>
      </div>
    )
  }
}
