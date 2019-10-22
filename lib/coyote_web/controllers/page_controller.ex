defmodule CoyoteWeb.PageController do
  use CoyoteWeb, :controller

  def index(conn, _params) do
    render(conn, "index.html")
  end
end
