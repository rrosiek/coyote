defmodule Coyote.MailTest do
  use Coyote.DataCase

  alias Coyote.Mail

  describe "correspondence" do
    alias Coyote.Mail.Correspondence

    @valid_attrs %{subject: "some subject"}
    @update_attrs %{subject: "some updated subject"}
    @invalid_attrs %{subject: nil}
  end
end
