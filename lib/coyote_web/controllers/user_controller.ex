defmodule CoyoteWeb.UserController do
  use CoyoteWeb, :controller

  def index(conn, params) do
    page = Coyote.Accounts.list_users(params)

    render(conn, "index.html", page: page)
  end
end
